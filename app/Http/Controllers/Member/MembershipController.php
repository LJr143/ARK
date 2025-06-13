<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Notifications\MembershipCredentialsNotification;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class MembershipController extends Controller
{
    public function showForm(Request $request, $step = 1)
    {
        return view('ark.member.pages.registration.membership-registration', [
            'currentStep' => $step,
            'memberData' => $request->session()->get('member_data', [])
        ]);
    }

    protected function isSuperAdminExists(): bool
    {
        return Role::where('name', 'superadmin')->whereHas('users')->exists();
    }

    public function saveStep(Request $request, $step)
    {
        $rules = $this->getValidationRules($step);
        $validated = $request->validate($rules);
        $password = Str::random(10);

        $memberData = $request->session()->get('member_data', []);
        $memberData = array_merge($memberData, $validated);

        $request->session()->put('member_data', $memberData);

        if ($step < 4) {
            return redirect()->route('membership.form', ['step' => $step + 1]);
        }

        $memberData['status'] = 'pending';
        $memberData['username'] = $memberData['email'];
        $memberData['password'] = Hash::make($password);
        $memberData['force_password_change'] = true;

        $user = User::create($memberData);

        if (!$this->isSuperAdminExists()) {
            $user->assignRole('superadmin');
            $user->update([
                'status' => 'approved',
                'is_approved' => true,
            ]);
            $user->notify(new MembershipCredentialsNotification($password));
        } else {
            $user->assignRole('member');
        }

        $request->session()->forget('member_data');

        // Flash success message to session
        $request->session()->flash('registration_success', [
            'title' => "You're all set!",
            'message' => "Thanks for signing up. We've sent your temporary password to your email. " .
                "Check your inbox (or spam folder—just in case) and log in when you're ready!"
        ]);

        return redirect()->route('member.registration.success');
    }

    protected function getValidationRules($step)
    {
        $rules = [];
        switch ($step) {
            case 1:
                $rules = [
                    'family_name' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'birthdate' => [
                        'required',
                        'date',
                        function ($attribute, $value, $fail) {
                            $minAge = 22;
                            $birthdate = new DateTime($value);
                            $today = new DateTime();
                            $age = $today->diff($birthdate)->y;

                            if ($age < $minAge) {
                                $fail("You must be at least {$minAge} years old.");
                            }
                        },
                    ],
                    'birthplace' => 'nullable|string|max:255',
                    'sex' => 'nullable|in:Male,Female,Other',
                    'civil_status' => 'nullable|in:Single,Married,Divorced,Widowed',
                    'permanent_address' => 'nullable|string',
                    'telephone' => 'nullable|string|max:20',
                    'fax' => 'nullable|string|max:20',
                    'mobile' => 'required|numeric|max:11',
                    'email' => 'required|email|unique:users,email',
                    'facebook_id' => 'nullable|string|max:255',
                    'twitter_id' => 'nullable|string|max:255',
                    'skype_id' => 'nullable|string|max:255',
                    'website' => 'nullable|url|max:255',
                ];
                break;
            case 2:
                $rules = [
                    'company_name' => 'nullable|string|max:255',
                    'company_address' => 'nullable|string',
                    'company_telephone' => 'nullable|string|max:20',
                    'company_fax' => 'nullable|string|max:20',
                    'designation' => 'nullable|string|max:255',
                    'school_graduated' => 'nullable|string|max:255',
                    'year_graduated' => 'required|integer|min:1900|max:' . date('Y'),
                    'honors' => 'nullable|string|max:255',
                    'post_graduate_school' => 'nullable|string|max:255',
                    'post_graduate_year' => 'nullable|integer|min:1900|max:' . date('Y'),
                    'post_graduate_honors' => 'nullable|string|max:255',
                    'special_courses' => 'nullable|string',
                    'awards' => 'nullable|string',
                ];
                break;
            case 3:
                $rules = [
                    'prc_registration_number' => 'required|numeric',
                    'prc_date_issued' => 'required|date',
                    'prc_valid_until' => 'required|date', //TODO: MATCH WITH BIRTHDATE
                    'expertise' => 'nullable|string',
                    'years_of_practice' => 'nullable|integer|min:0',
                    'practice_type' => 'nullable|in:Private,Government,Academe,Mixed',
                    'services_rendered' => 'nullable|string',
                    'cpe_seminars_attended' => 'nullable|string',
                ];
                break;
            case 4:
                $rules = [
                    'current_chapter' => 'required|string|max:255',
                    'previous_chapter' => 'nullable|string|max:255',
                    'positions_held' => 'nullable|string',
                ];
                break;
        }
        return $rules;
    }
}

<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Notifications\MembershipCredentialsNotification;
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

        // Final step - save to database
        $memberData['status'] = 'pending';
        $memberData['username'] = $memberData['email'];
        $memberData['password'] = Hash::make($password);
        $memberData['force_password_change'] = true;

        $user = User::create($memberData);

        if(!$this->isSuperAdminExists()){
            $user->assignRole('superadmin');
            $user->notify(new MembershipCredentialsNotification($password));
        }else{
            $user->assignRole('member');
        }

        $request->session()->forget('member_data');

        return redirect()->route('member.login');
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
                    'birthdate' => 'required|date', //TODO: VALIDATION RULES AT LEAST 20
                    'birthplace' => 'required|string|max:255',
                    'sex' => 'required|in:Male,Female,Other',
                    'civil_status' => 'required|in:Single,Married,Divorced,Widowed',
                    'permanent_address' => 'required|string',
                    'telephone' => 'nullable|string|max:20',
                    'fax' => 'nullable|string|max:20',
                    'mobile' => 'required|string|max:11', //TODO: MOBILE NUMBER FORMAT
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
                    'school_graduated' => 'required|string|max:255',
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
                    'prc_registration_number' => 'required|string|max:255', //TODO: LIMITATION  TO STANDARD PRC NUMBER
                    'prc_date_issued' => 'required|date',
                    'prc_valid_until' => 'required|date', //TODO: MATCH WITH BIRTHDATE
                    'expertise' => 'required|string',
                    'years_of_practice' => 'required|integer|min:0',
                    'practice_type' => 'required|in:Private,Government,Academe,Mixed',
                    'services_rendered' => 'required|string',
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

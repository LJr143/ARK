<?php

namespace App\Livewire\Request;

use App\Models\ComputationRequest;
use App\Models\ComputationRequestReply;
use App\Models\Due;
use App\Models\FiscalYear;
use App\Models\User;
use App\Notifications\DuesComputationNotification;
use App\Services\FiscalYearService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ComputationalRequest extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $statusFilter = '';
    public $showModal = false;
    public $showViewModal = false;
    public $member_id;
    public $requestDetails;
    public string $referenceNumber = '';
    public bool $unpaidOnly = false;
    public ?array $computation = null;
    public string $message = '';
    public bool $computationCompleted = false;
    public string $replyMessage = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];
    public function mount(): void
    {
        //
    }

    public function render()
    {
        $requests = ComputationRequest::query()
            ->with(['member' => function ($query) {
                $query->select('id', 'first_name', 'family_name', 'middle_name', 'email', 'prc_registration_number');
            }, 'replies' => function ($query) {
                $query->latest('replied_at');
            }])
            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where('id', 'like', $searchTerm)
                    ->orWhere('reference_number', 'like', $searchTerm)
                    ->orWhere('status', 'like', $searchTerm)
                    ->orWhereHas('member', function ($q) use ($searchTerm) {
                        $q->where('first_name', 'like', $searchTerm)
                            ->orWhere('family_name', 'like', $searchTerm)
                            ->orWhere('email', 'like', $searchTerm)
                            ->orWhere('prc_registration_number', 'like', $searchTerm)
                            ->orWhereRaw("CONCAT(first_name, ' ', family_name) LIKE ?", [$searchTerm]);
                    });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.request.computational-request', compact('requests'));
    }

    public function openViewModal($id): void
    {
        $this->requestDetails = ComputationRequest::with('replies.admin')->findOrFail($id);
        $this->referenceNumber = $this->requestDetails->reference_number;
        $this->member_id = $this->requestDetails->member_id;
        $this->showViewModal = true;
        $this->computation = null;
        $this->computationCompleted = false;
        $this->replyMessage = '';
        $this->message = '';
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->showViewModal = false;
        $this->resetForm();
    }

    public function save(): void
    {
        $rules = $this->rules ?? [
            'first_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'prc_registration_number' => 'required|string|max:50|unique:users,prc_registration_number',
            'mobile' => 'nullable|string|max:20',
            'status' => 'required|string',
            'current_chapter' => 'nullable|string|max:255',
        ];

        if ($this->editMode) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->member_id;
            $rules['prc_registration_number'] = 'required|string|max:50|unique:users,prc_registration_number,' . $this->member_id;
        }

        $this->validate($rules);

        $data = [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'family_name' => $this->family_name,
            'prc_registration_number' => $this->prc_registration_number,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'current_chapter' => $this->current_chapter,
        ];

        if ($this->editMode) {
            User::findOrFail($this->member_id)->update($data);
            session()->flash('message', 'Member updated successfully!');
        } else {
            User::create($data);
            session()->flash('message', 'Member added successfully!');
        }

        $this->closeModal();
    }

    public function computeDues(): void
    {
        try {
            $this->computation = app(FiscalYearService::class)->generateComputation($this->referenceNumber, $this->unpaidOnly);
            $this->message = $this->computation
                ? 'Dues computed successfully.'
                : 'No ' . ($this->unpaidOnly ? 'unpaid ' : '') . ' dues found for this reference number.';
            $this->computationCompleted = true;
        } catch (\Exception $e) {
            $this->message = 'Error computing dues: ' . $e->getMessage();
            $this->computationCompleted = false;
        }
    }

    public function sendReply(): void
    {
        try {
            $request = ComputationRequest::where('reference_number', $this->referenceNumber)->firstOrFail();
            $member = User::findOrFail($request->member_id);

            // Handle empty computation scenarios
            if (empty($this->computation) || $this->isComputationEmpty($this->computation)) {
                $this->handleEmptyDuesComputation($request, $member);
                return;
            }

            // Prepare computation data with Dues IDs
            $updatedComputation = $this->computation;
            $totalAmount = 0;
            $totalUnpaid = 0;

            if (!empty($this->computation['dues'])) {
                $updatedDues = [];
                foreach ($this->computation['dues'] as $dueData) {
                    $fiscalYear = FiscalYear::where('name', $dueData['fiscal_year'])->firstOrFail();
                    $due = Due::firstOrCreate(
                        [
                            'member_id' => $request->member_id,
                            'fiscal_year_id' => $fiscalYear->id,
                        ],
                        [
                            'amount' => $dueData['amount'],
                            'penalty_amount' => $dueData['penalty'] ?? 0,
                            'due_date' => $dueData['due_date'],
                            'status' => $dueData['status'],
                        ]
                    );

                    $total = $due->amount + $due->penalty_amount;
                    $updatedDues[] = [
                        'id' => $due->id,
                        'fiscal_year' => $fiscalYear->year,
                        'amount' => $due->amount,
                        'penalty' => $due->penalty_amount,
                        'total' => $total,
                        'due_date' => $due->due_date,
                        'status' => $due->status,
                        'is_past_fiscal_year' => now()->year > $fiscalYear->year,
                    ];

                    $totalAmount += $total;
                    if ($due->status === 'unpaid') {
                        $totalUnpaid += $total;
                    }
                }
                $updatedComputation['dues'] = $updatedDues;
                $updatedComputation['total_amount'] = $totalAmount;
                $updatedComputation['total_unpaid'] = $totalUnpaid;
            }

            // Store reply in database
            $reply = ComputationRequestReply::create([
                'reference_number' => $this->referenceNumber,
                'member_id' => $request->member_id,
                'admin_id' => auth()->id(),
                'reply_message' => $this->replyMessage ?? 'Dues computation completed successfully.',
                'computation_data' => $updatedComputation,
                'reply_type' => 'approved',
                'has_computation' => true,
                'is_empty_computation' => false,
                'replied_at' => now(),
            ]);

            // Prepare notification data for in-app notification
            $notificationData = [
                'computation_request_id' => $this->referenceNumber,
                'member_data' => [
                    'name' => $member->first_name . ' ' . ($member->last_name ?? ''),
                    'email' => $member->email ?? 'Unknown',
                    'prc_number' => $member->prc_registration_number ?? 'N/A',
                    'chapter' => $member->current_chapter ?? 'Unknown',
                ],
                'reply_message' => $this->replyMessage ?? 'None provided',
                'computation' => $updatedComputation,
                'submitted_at' => now()->toISOString(),
            ];

            // Send email notification using DuesComputationNotification
            Notification::send($member, new DuesComputationNotification(
                $updatedComputation,
                $this->replyMessage,
                $request->member_id
            ));

            // Send in-app notification using CustomNotification
            $inAppMessage = $this->buildMemberNotificationMessage($notificationData);
            $member->notify(new \App\Notifications\CustomNotification(
                'Dues Computation Reply',
                $inAppMessage,
                'computation_reply',
                'high',
                $notificationData,
                $member->id
            ));

            // Update request status
            $request->update(['status' => 'approved']);

            // Log success
            Log::info('Dues computation reply sent and status updated', [
                'reference_number' => $this->referenceNumber,
                'member_id' => $request->member_id,
                'reply_id' => $reply->id,
            ]);

            $this->message = 'Reply sent and request approved successfully.';
            $this->computationCompleted = false;
            $this->showViewModal = false;
            $this->resetForm();
        } catch (\Exception $e) {
            Log::error('Failed to send dues computation reply: ' . $e->getMessage(), [
                'reference_number' => $this->referenceNumber,
                'exception' => $e,
            ]);
            $this->message = 'Error sending reply: ' . $e->getMessage();
        }
    }

    private function handleEmptyDuesComputation($request, $member): void
    {
        $emptyComputationMessage = $this->replyMessage ?? 'No outstanding dues found for your account at this time.';

        // Store empty computation reply in database
        $reply = ComputationRequestReply::create([
            'reference_number' => $this->referenceNumber,
            'member_id' => $request->member_id,
            'admin_id' => auth()->id(),
            'reply_message' => $emptyComputationMessage,
            'computation_data' => null,
            'reply_type' => 'completed',
            'has_computation' => false,
            'is_empty_computation' => true,
            'replied_at' => now(),
        ]);

        // Prepare notification data for empty computation
        $notificationData = [
            'computation_request_id' => $this->referenceNumber,
            'member_data' => [
                'name' => $member->first_name . ' ' . ($member->last_name ?? ''),
                'email' => $member->email ?? 'Unknown',
                'prc_number' => $member->prc_registration_number ?? 'N/A',
                'chapter' => $member->current_chapter ?? 'Unknown',
            ],
            'reply_message' => $emptyComputationMessage,
            'computation' => null,
            'no_dues_found' => true,
            'submitted_at' => now()->toISOString(),
        ];

        // Send email notification for empty computation
        Notification::send($member, new DuesComputationNotification(
            (array)null, // No computation data
            $emptyComputationMessage,
            $this->member_id
        ));

        // Send in-app notification for empty computation
        $inAppMessage = $this->buildEmptyDuesNotificationMessage($notificationData);
        $member->notify(new \App\Notifications\CustomNotification(
            'Dues Computation Reply - No Outstanding Dues',
            $inAppMessage,
            'computation_reply_empty',
            'medium',
            $notificationData,
            $member->id
        ));

        // Update request status to completed instead of approved
        $request->update(['status' => 'completed', 'notes' => 'No outstanding dues found']);

        // Log the empty computation scenario
        Log::info('Empty dues computation reply sent', [
            'reference_number' => $this->referenceNumber,
            'member_id' => $this->member_id,
            'reason' => 'No outstanding dues found',
            'reply_id' => $reply->id,
        ]);

        $this->message = 'Reply sent successfully - No outstanding dues found for this member.';
        $this->computationCompleted = false;
        $this->showViewModal = false;
        $this->resetForm();
    }

    private function isComputationEmpty($computation): bool
    {
        if (is_null($computation)) {
            return true;
        }

        if (is_array($computation)) {
            // Check if array is empty or contains only empty/null values
            $nonEmptyValues = array_filter($computation, function ($value) {
                if (is_array($value)) {
                    return !empty($value);
                }
                return !is_null($value) && $value !== '' && $value !== 0;
            });
            return empty($nonEmptyValues);
        }

        if (is_string($computation)) {
            return trim($computation) === '';
        }

        if (is_object($computation)) {
            // For objects, check if they have any meaningful properties
            $properties = get_object_vars($computation);
            if (empty($properties)) {
                return true;
            }

            // Check if all properties are empty
            foreach ($properties as $value) {
                if (!is_null($value) && $value !== '' && $value !== 0) {
                    return false;
                }
            }
            return true;
        }

        return false;
    }

    private function buildEmptyDuesNotificationMessage($notificationData): string
    {
        $memberName = $notificationData['member_data']['name'];
        $message = "Dear {$memberName},\n\n";
        $message .= "We have reviewed your dues computation request (Reference: {$notificationData['computation_request_id']}).\n\n";
        $message .= "Good news! No outstanding dues were found for your account at this time.\n\n";

        if (!empty($notificationData['reply_message']) && $notificationData['reply_message'] !== 'None provided') {
            $message .= "Additional Information:\n{$notificationData['reply_message']}\n\n";
        }

        $message .= "If you have any questions or believe this may be an error, please contact your chapter administrator.\n\n";
        $message .= "Thank you for your inquiry.";

        return $message;
    }

    public function validateComputationData(): bool
    {
        if (empty($this->computation) || $this->isComputationEmpty($this->computation)) {
            // You might want to show a confirmation dialog here
            $this->dispatchBrowserEvent('show-empty-dues-confirmation', [
                'message' => 'No dues computation data found. Do you want to proceed with sending a "no outstanding dues" notification?'
            ]);
            return false;
        }
        return true;
    }

    private function buildMemberNotificationMessage(array $notificationData): string
    {
        $memberName = $notificationData['member_data']['name'] ?? 'Member';
        $prcNumber = $notificationData['member_data']['prc_number'] ?? 'N/A';
        $replyMessage = $notificationData['reply_message'] ?? 'No additional message provided';

        $message = "Your dues computation request (Ref: {$notificationData['computation_request_id']}) has been approved for {$memberName} (PRC# {$prcNumber}).";

        if (!empty($replyMessage)) {
            $message .= "\n\nMessage: " . $replyMessage;
        }

        $message .= "\n\nPlease check the details in your account.";

        return $message;
    }

    public function rejectRequest(): void
    {
        try {
            $request = ComputationRequest::where('reference_number', $this->referenceNumber)->firstOrFail();

            // Store rejection reply in database
            ComputationRequestReply::create([
                'reference_number' => $this->referenceNumber,
                'member_id' => $request->member_id,
                'admin_id' => auth()->id(),
                'reply_message' => $this->replyMessage ?? 'Your computation request has been rejected.',
                'computation_data' => null,
                'reply_type' => 'rejected',
                'has_computation' => false,
                'is_empty_computation' => false,
                'replied_at' => now(),
            ]);

            $request->update(['status' => 'rejected']);
            $this->message = 'Request rejected successfully.';
            $this->showViewModal = false;
            $this->resetForm();
        } catch (\Exception $e) {
            Log::error('Failed to reject request: ' . $e->getMessage(), ['reference_number' => $this->referenceNumber]);
            $this->message = 'Error rejecting request: ' . $e->getMessage();
        }
    }

    public function resetForm(): void
    {
        $this->reset();
    }

    public function delete($reference_number): void
    {
        ComputationRequest::findOrFail($reference_number)->delete();
        session()->flash('message', 'Request deleted successfully!');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }
}

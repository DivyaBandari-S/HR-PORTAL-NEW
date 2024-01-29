<?php
// Created by : Bandari Divya
// About this component:this page for to display leave apply form, pending and history of applied leave applications
namespace App\Livewire;

use Livewire\Component;
use App\Models\LeaveRequest;
use App\Models\EmployeeDetails;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LeavePage extends Component
{
    public $employeeDetails = [];
    public $activeTab = 'active';
    public $employeeId;
    public $leaveRequests;
    public $leavePending;
    public function mount()
{
    // Get the logged-in user's ID and company ID
    $employeeId = auth()->guard('emp')->user()->emp_id;
    // Fetch all leave requests (pending, approved, rejected) for the logged-in user and company
    $this->leaveRequests = LeaveRequest::where('emp_id', $employeeId)
        ->whereIn('status', ['approved', 'rejected','Withdrawn'])
        ->orderBy('created_at', 'desc')
        ->get();
    // Fetch pending leave requests for the logged-in user and company
    $this->leavePending = LeaveRequest::where('emp_id', $employeeId)
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();

    // Format the date properties
    foreach ($this->leaveRequests as $leaveRequest) {
        $leaveRequest->formatted_from_date = Carbon::parse($leaveRequest->from_date)->format('d-m-Y');
        $leaveRequest->formatted_to_date = Carbon::parse($leaveRequest->to_date)->format('d-m-Y');
        // Add other formatted date properties as needed
    }

    foreach ($this->leavePending as $leaveRequest) {
        $leaveRequest->formatted_from_date = Carbon::parse($leaveRequest->from_date)->format('d-m-Y');
        $leaveRequest->formatted_to_date = Carbon::parse($leaveRequest->to_date)->format('d-m-Y');
        // Add other formatted date properties as needed
    }
}

    
    public function hasPendingLeave()
    {
        // Check if there are pending leave requests
        return $this->leaveRequests->where('status', 'pending')->isNotEmpty();
    }

        public  function calculateNumberOfDays($fromDate, $fromSession, $toDate, $toSession)
        {
            try {
                $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $fromDate . ' 00:00:00');
                $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $toDate . ' 00:00:00');
                // Check if the start and end sessions are different on the same day
                if (
                    $startDate->isSameDay($endDate) &&
                    $this->getSessionNumber($fromSession) === $this->getSessionNumber($toSession)
                ) {
                    // Inner condition to check if both start and end dates are weekdays
                    if (!$startDate->isWeekend() && !$endDate->isWeekend()) {
                        return 0.5;
                    } else {
                        // If either start or end date is a weekend, return 0
                        return 0;
                    }
                }
                if (
                    $startDate->isSameDay($endDate) &&
                    $this->getSessionNumber($fromSession) !== $this->getSessionNumber($toSession)
                ) {
                    // Inner condition to check if both start and end dates are weekdays
                    if (!$startDate->isWeekend() && !$endDate->isWeekend()) {
                        return 1;
                    } else {
                        // If either start or end date is a weekend, return 0
                        return 0;
                    }
                }
                

                $totalDays = 0;

                while ($startDate->lte($endDate)) {
                    // Check if it's a weekday (Monday to Friday)
                    if ($startDate->isWeekday()) {
                        $totalDays += 1;
                    }

                    // Move to the next day
                    $startDate->addDay();
                }

                // Deduct weekends based on the session numbers
                if ($this->getSessionNumber($fromSession) > 1) {
                    $totalDays -= $this->getSessionNumber($fromSession) - 1; // Deduct days for the starting session
                }
                if ($this->getSessionNumber($toSession) < 2) {
                    $totalDays -= 2 - $this->getSessionNumber($toSession); // Deduct days for the ending session
                }
                // Adjust for half days
                if ($this->getSessionNumber($fromSession) === $this->getSessionNumber($toSession)) {
                    // If start and end sessions are the same, check if the session is not 1
                    if ($this->getSessionNumber($fromSession) !== 1) {
                        $totalDays += 0.5; // Add half a day
                    }
                }elseif($this->getSessionNumber($fromSession) !== $this->getSessionNumber($toSession)){
                    if ($this->getSessionNumber($fromSession) !== 1) {
                        $totalDays += 1; // Add half a day
                    }
                }
                else {
                    $totalDays += ($this->getSessionNumber($toSession) - $this->getSessionNumber($fromSession) + 1) * 0.5;
                }

                return $totalDays;

            } catch (\Exception $e) {
                return 'Error: ' . $e->getMessage();
            }
        }

    
        private function getSessionNumber($session)
        {
            // You might need to customize this based on your actual session values
            return (int) str_replace('Session ', '', $session);
        }
        
        public function cancelLeave($leaveRequestId)
        {
            // Find the leave request by ID
            $leaveRequest = LeaveRequest::find($leaveRequestId);
    
            // Update status to 'rejected'
            $leaveRequest->status = 'Withdrawn';
            $leaveRequest->save();
            $leaveRequest->touch();
    
            session()->flash('message', 'Leave application Withdrawn .');
        }

        
    public function render()
    {
        return view('livewire.leave-page');
    }
   
}

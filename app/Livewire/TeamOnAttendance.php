<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\EmployeeDetails;
use App\Models\Regularisations;
use Carbon\Carbon;
class TeamOnAttendance extends Component
{
    public $showTeamOnAttendance = false;
    public $data8;
    
  
    public function render()
    {
        
        $loggedInEmpId = Auth::guard('emp')->user()->emp_id;
        
        // Check if the logged-in user is a manager by comparing emp_id with manager_id in employeedetails
        $isManager = EmployeeDetails::where('manager_id', $loggedInEmpId)->exists();
      
        // Show "Team on Leave" if the logged-in user is a manager
        $this->showTeamOnAttendance = $isManager;
       
        return view('livewire.team-on-attendance');
    }
}

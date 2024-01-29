<?php
// Created by : Bandari Divya
// About this component: Displaying Holidays list 
namespace App\Livewire;

use Carbon\Carbon;

use Livewire\Component;
use App\Models\HolidayCalendar;
class HolidayCalender extends Component
{
    public $year; 
    public function mount()
    {
        // Set the default year to the current year
        $this->year = Carbon::now()->year;
    }
    public function render()
    {
        try {
            $currentYear = Carbon::now()->year;
            $this->year = $currentYear;
                    // Fetch data for the current year
                    $calendarData = HolidayCalendar::where('year', $this->year)->get();

                    // Fetch data for the previous year
                    $calendarDataPrevious = HolidayCalendar::where('year', $currentYear - 1)->get();
        
                    // Fetch data for the next year
                    $calendarDataNext = HolidayCalendar::where('year', $currentYear + 1)->get();
        
                    // Merge the data for all years
                    $calendarData = $calendarData->concat($calendarDataPrevious)->concat($calendarDataNext);
      
        } catch (\Exception $e) {
            // Handle the exception, log it, or display an error message
            \Log::error('Error fetching calendar data: ' . $e->getMessage());
    
            $calendarData = [];
        }
    
        return view('livewire.holiday-calender', [
            'calendarData' => $calendarData,
        ]);
    }

}

<div>
<body>

<div class="applyContainer" style="border: 1px solid #DCDCDC;border-radius: 10px;box-shadow: 1px 2px 2px 2px #F5F5F5; width: 100%; margin: 10px auto; background: #FFFFFF;
    padding:10px 15px;">
    <h6 class="pb-3">Applying for Leave</h6> 
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form wire:submit.prevent="leaveApply" enctype="multipart/form-data">
        <div class="form-group mt-2">
            <label for="leaveType">Leave type</label>
                <select class="form-control" wire:model="leave_type" id="leaveType" name="leaveType" style="width: 50%; font-weight: 400;font-size: 12px; color: #778899;" onchange="toggleReporting()">
                    <option value="default">Select Type</option>
                    <option value="Causal Leave Probation">Casual Leave</option>
                    <option value="Loss of Pay">Loss of Pay</option>
                    @if($employeeGender && $employeeGender->gender === 'Female')
                    <option value="Maternity Leave">Maternity Leave</option>
                    @else
                    <option value="Maternity Leave">Petarnity Leave</option>
                    @endif
                    <option value="Sick Leave">Sick Leave</option>
                </select>
                  @error('leave_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="d-flex m-0 p-0 gap-2 ">
                <div class="col-md-6 p-0">
                    <div class="form-group">
                        <label for="fromDate" >From date</label>
                        <input type="date" wire:model="from_date" class="form-control" id="fromDate" name="fromDate" style="color: #778899;">
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="form-group">
                        <label for="session" >Session</label>
                        <select class="form-control" wire:model="from_session" id="session" name="session" style="font-weight: 500; ">
                            <option value="default">Select session</option>
                            <option value="Session 1">Session 1</option>
                            <option value="Session 2">Session 2</option>
                        </select>
                    </div>
                   @error('from_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
        <div class="d-flex m-0 p-0 gap-2">
                <div class="col-md-6 p-0">
                    <div class="form-group">
                        <label for="toDate" >To date</label>
                        <input type="date" wire:model="to_date" class="form-control" id="toDate" name="toDate" style="color: #778899;">
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="form-group">
                        <label for="session" >Session</label>
                        <select class="form-control" wire:model="to_session" id="session" name="session" style="font-weight: 500;">
                            <option value="default" style="font-size:12px;">Select session</option>
                            <option value="Session 1">Session 1</option>
                            <option value="Session 2">Session 2</option>
                        </select>
                    </div>
                    @error('to_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
       
            <div>
                <div class="form-group mt-2" style="margin-top: 10px;">
                    <div style="display:flex; flex-direction:row;">
                        <label for="applyingToText" id="applyingToText" name="applyingTo" >
                            Applying To
                        </label>
                    </div>
                </div>

                <div class="reporting border" style="display:none; width:280px;" >
                    <div>
                        <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars.png" alt="Default User Image" style="width: 30px; height: 30px; border-radius: 50%;">
                    </div>
                    <div class="center">
                        <p id="reportToText" class="ellipsis" style="font-size:12px;font-weight:500; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 200px; display: inline-block;">{{$reportTo}}</p>
                        <p style="margin-top:-10px; color:#778899; font-size:10px;" id="managerIdText"><span class="remaining" >#{{$managerId}}</span></p>
                    </div>
                    <div class="downArrow" onclick="toggleSearchContainer()">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                       <!-- Details to show on hover -->
                   
                </div>
                <div class="searchContainer" style="display:none; width:50%; max-height:300px;">
                    <!-- Content for the search container -->
                    <div class="row px-2 py-0 mb-1" >
                        <div class="col m-0 p-0">
                            <div class="input-group">
                                <input wire:click="filterData" style="font-size: 10px; border-radius: 5px 0 0 5px; cursor: pointer; width:50%;" type="text" class="form-control" placeholder="Search for Emp.Name or ID" aria-label="Search" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button style="height: 29px; border-radius: 0 5px 5px 0; background-color: #007BFF; color: #fff; border: none; align-items: center; display: flex;" class="btn" type="button">
                                        <i style="margin-right: 5px;" class="fa fa-search"></i> <!-- Adjust margin-right as needed -->
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($employeeDetails as $employee)
                        <div class="d-flex gap-3 align-item-center" onclick="updateApplyingTo('{{ $employee['report_to']}}' , '{{ $employee['manager_id'] }}')">
                            <div>
                              <input type="checkbox" wire:model="selectedManager" value="{{ $employee['manager_id'] }}">
                            </div>
                               <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars.png" alt="Default User Image" style="width: 30px; height: 30px; border-radius: 50%;">
                            <div class="center ">
                                <p style=" font-size:12px; font-weight:500;"value="{{ $employee['report_to'] }}">{{ $employee['report_to'] }}</p>
                                <p style="margin-top:-5px; color:#778899; font-size:10px;" value="{{ $employee['manager_id'] }}">#{{ $employee['manager_id'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('applying_to') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        <div class="form-group mt-2">
            <label for="ccToText" wire:model="from_date" id="applyingToText" name="applyingTo">
                CC to
            </label>
            <div class="control-wrapper" style="display: flex; flex-direction: row; gap: 10px;">
                <a href="javascript:void(0);" class="text-3 text-secondary control" aria-haspopup="true" onclick="toggleCCField()" style="text-decoration: none;">
                    <div class="icon-container" >
                        <i class="fas fa-plus" style="color: #778899;"></i>
                    </div>
                </a>
                <span class="text-2 text-secondary placeholder" id="ccPlaceholder" style="margin-top: 5px; background: transparent; color: #ccc;">Add</span>   
    
               <div id="addedEmails" ></div>
            
            </div>
            <div class="ccContainer" style="display:none;width:50%; max-height:300px;">
                    <!-- Content for the search container -->
                    <div class="row" style="padding: 0 15px; margin-bottom: 10px;">
                        <div class="col" style="margin: 0px; padding: 0px">
                            <div class="input-group">
                                <input  style="font-size: 10px; border-radius: 5px 0 0 5px; cursor: pointer; width:50%;" type="text" class="form-control" placeholder="Search for Emp.Name or ID" aria-label="Search" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button wire:click="filterCcData" style="height: 29px; border-radius: 0 5px 5px 0; background-color: #007BFF; color: #fff; border: none; align-items: center; display: flex;" class="btn" type="button" >
                                        <i style="margin-right: 5px;" class="fa fa-search"></i> <!-- Adjust margin-right as needed -->
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @foreach($ccRecipients as $employee)
                        <div style="display:flex; gap:10px; align-items:center;"onclick="addEmail('{{ $employee['full_name'] }}')">
                            <input type="checkbox" wire:model="selectedPeople" value="{{ $employee['emp_id'] }}">
                            <img src="{{ $employee['image'] ? $employee['image'] : 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars.png' }}" alt="User Image" style="width: 30px; height: 30px; border-radius: 50%;">
                            <div class="center mt-3">
                                <p style="font-size: 12px; font-weight: 500;">{{ $employee['full_name'] }} <br>
                                <span style=" color: #778899; font-size: 10px;">#{{ $employee['emp_id'] }}</span>
                            </p>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('cc_to') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
            <div class="form-group mt-2">
                <label for="contactDetails" >Contact Details</label>
                <input type="text" wire:model="contact_details" class="form-control" id="contactDetails" name="contactDetails" style="color: #778899;width:50%;">
                @error('contact_details') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mt-2">
                <label for="reason" >Reason for Leave</label>
                <textarea class="form-control" wire:model="reason" id="reason" name="reason" placeholder="Enter Reason" rows="4" ></textarea>
                @error('reason') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mt-4">
             <input type="file" wire:model="files" wire:loading.attr="disabled" multiple />
                 @error('file_paths') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        
            <div class="buttons1">
              <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" >Cancel</button>
            </div>
    </form>
</div>
<script>
       function toggleReporting() {
        const leaveType = document.getElementById('leaveType');
        const reportingDiv = document.querySelector('.reporting');
        const applyingToTextDiv = document.getElementById('applyingToText');

        // Show or hide the reporting div based on the selected leave type
        if (leaveType.value !== 'default') {
            reportingDiv.style.display = 'flex';
            applyingToTextDiv.style.display = 'none';
        } else {
            reportingDiv.style.display = 'none';
            applyingToTextDiv.style.display = 'flex';
        }
    }
    function toggleSearchContainer() {
        const searchContainer = document.querySelector('.searchContainer');
        const reportingContainer = document.querySelector('.reporting');
        // Toggle the display of the search container
        searchContainer.style.display = searchContainer.style.display === 'none' ? 'block' : 'none';
        if (searchContainer.style.display === 'block') {
        reportingContainer.classList.add('active');
    } else {
        reportingContainer.classList.remove('active');
    }
    }
    function toggleCCField() {
        const ccContainer = document.querySelector('.ccContainer');
        const iconContainer = document.querySelector('.icon-container');

        // Toggle the display of the search container
        ccContainer.style.display = ccContainer.style.display === 'none' ? 'block' : 'none';
        if (ccContainer.style.display === 'block') {
            iconContainer.classList.add('active');
    } else {
        iconContainer.classList.remove('active');
    }
    }
    function addEmail(fullName) {
    const addedEmails = document.getElementById('addedEmails');
    const addSpan = document.getElementById('ccPlaceholder');

    // Split the full name into first and last names
    const names = fullName.split(' ');

    // Get the first letter of the first name
    const firstNameAbbreviation = names.length > 0 ? names[0].charAt(0) : '';

    // Get the first letter of the last name
    const lastNameAbbreviation = names.length > 1 ? names[names.length - 1].charAt(0) : '';

    // Combine the first letters of both names to create the email abbreviation
    const emailAbbreviation = firstNameAbbreviation + lastNameAbbreviation;

    // Check if the email abbreviation is already added
    if (isEmailAlreadyAdded(emailAbbreviation)) {
        return; // Do nothing if the email is already added
    }

    // Create a new element to display the added email abbreviation
    const emailElement = document.createElement('div');
    emailElement.textContent = emailAbbreviation;
    emailElement.className = 'added-email';
    emailElement.style.border = '2px solid #778899';
    emailElement.style.color = '#778899';
    emailElement.style.borderRadius = '50%';

    // Add hover effect
    emailElement.addEventListener('mouseover', function() {
        emailElement.style.cursor = 'pointer';
        emailElement.innerHTML = '&#9587;'; // Change the color to black
    });

    emailElement.addEventListener('mouseout', function() {
        emailElement.innerHTML = emailAbbreviation; // Restore the email abbreviation on mouseout
    });

    // Remove on click
    emailElement.addEventListener('click', function() {
        emailElement.remove();
        removeAddedEmail(emailAbbreviation); // Remove from the list of added emails
        if (addedEmails.children.length === 0) {
            addSpan.style.display = 'block';
        }
    });

    // Append the email element to the addedEmails container
    addedEmails.appendChild(emailElement);
    addSpan.style.display = 'none';
    // Add the email to the list of added emails
    addedEmailList.push(emailAbbreviation);
}

// Array to keep track of added emails
const addedEmailList = [];

// Function to check if an email is already added
function isEmailAlreadyAdded(email) {
    return addedEmailList.includes(email);
}

// Function to remove an email from the list of added emails
function removeAddedEmail(email) {
    const index = addedEmailList.indexOf(email);
    if (index !== -1) {
        addedEmailList.splice(index, 1);
    }
}

    function updateApplyingTo(reportTo, managerId) {
        // Update the values in the reporting container
        document.getElementById('reportToText').innerText = reportTo;
        document.getElementById('managerIdText').innerText = '#' + managerId;

        // Optionally, you can also hide the search container here
        toggleSearchContainer();
    }

function toggleDetails(tabId) {
            const tabs = ['leaveApply', 'restricted-content', 'leaveCancel-content', 'compOff-content'];

            tabs.forEach(tab => {
                const tabElement = document.getElementById(tab);
                if (tab === tabId) {
                    tabElement.style.display = 'block';
                } else {
                    tabElement.style.display = 'none';
                }
            });
        }

    </script>
@livewireScripts
</body>
</html>
</div>
<div>
  <style>
    .side a.active {
        color:  rgb(2, 17, 79);
        border-bottom: 2px solid  rgb(2, 17, 79);
        border-radius: 5%;
    }
  </style>
    <div class="toggle-container" style="width:95%;">
        @if(session()->has('message'))
        <div class="alert alert-success" style="display:flex; justify-content:space-between;">
            {{ session('message') }}
            <span class="close-btn" onclick="closeMessage()">X</span>
        </div>
        <script>
            // Close the success message after a certain time
            setTimeout(function() {
                closeMessage();
            }, 5000); // Adjust the time limit (in milliseconds) as needed
            function closeMessage() {
                document.querySelector('.alert-success').style.display = 'none';
            }
        </script>
        @endif
        
        <div class="nav-buttons  d-flex justify-content-center" style="font-family: 'Montserrat', sans-serif; text-decoration: none; cursor: pointer;">
            <ul class="nav custom-nav-tabs" style="list-style: none; display: flex; gap:10px;text-align:center;padding: 0;width:50%; font-weight:500;font-size: 12px;"> <!-- Apply the custom class to the nav -->
                <li class="flex-grow-1">
                    <a class="custom-nav-link active" data-section="leave" onclick="toggleDetails('leave', this)" style="color: #fff; background-color: rgb(2, 17, 79); padding: 5px; border: 1px solid  rgb(2, 17, 79); border-radius: 5px;">Apply</a>
                </li>
                <li class="flex-grow-1">
                    <a class="custom-nav-link active" data-section="accountDetails" onclick="toggleDetails('accountDetails', this)" style="color: #fff; padding: 5px; border: 1px solid #333; border-radius: 5px; background-color: rgb(2, 17, 79);">Pending</a>
                </li>
                <li class="flex-grow-1">
                    <a class="custom-nav-link active" data-section="familyDetails" onclick="toggleDetails('familyDetails', this)" style="color: #fff; padding: 5px; border: 1px solid #333; border-radius: 5px; background-color: rgb(2, 17, 79);">History</a>
                </li>
            </ul>
        </div>



        <div class="side" id="cardElement" style="display: flex; font-size: 12px; flex-direction: row; width: 80%; padding: 5px; border-radius: 5px; gap: 15px; margin-left: 40px; margin-top: 15px; cursor: pointer;">

            <div>
                <a class="active text-decoration-none text-dark" onclick="toggleOptions('leave', this)" data-section="leave">Leave</a>
            </div>
            <div class="line" style="height: 25px;width: 1px;border-right: 1px solid #ccc;"></div>
            <div>
                <a class="active text-decoration-none text-dark" onclick="toggleOptions('restricted', this)" data-section="restricted">Restricted Holiday</a>
            </div>
            <div class="line" style="height: 25px;width: 1px;border-right: 1px solid #ccc;"></div>
            <div>
                <a class="active text-decoration-none text-dark" onclick="toggleOptions('leaveCancel', this)" data-section="leaveCancel">Leave Cancel</a>
            </div>
            <div class="line" style="height: 25px;width: 1px;border-right: 1px solid #ccc;"></div>
            <div>
                <a class="active text-decoration-none text-dark" onclick="toggleOptions('compOff', this)" data-section="compOff">Comp Off Grant</a>
            </div>
        </div>


 
            <div class="row" id="leave" style="width:95%; margin-top:20px; margin:0 auto;">
        
               <div>@livewire('leave-apply')</div>
            </div>

        <div class="row" id="restricted" style="width:80%;margin-top:20px;display: none; margin-left:100px;">
            <div>
                <div class="leave-pending" style=" background:#fff;  display:flex;  width:100%;flex-direction:column;justify-content:center; border:1px solid #ccc; padding:20px;gap:10px;">
                    <div class="hide-info" style="display:flex; flex-direction:row;background:#FFFFF2;gap:50px; padding:5px 10px;font-size:0.725rem; text-align:start;align-items:center;">
                        <p style="font-size:0.725rem;">Restricted Holidays (RH) are a set of holidays allocated by the company that are optional for the employee to utilize. The company sets a limit on the amount of holidays that can be used.</p>
                        <p onclick="toggleInfo()" style="font-weight:500; color:#3a9efd;cursor:pointer;">Hide</p>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <p style="color:#333; font-size:0.95rem; font-weight:500;text-align:start; ">Applying for Restricted Holiday</p>
                        <p class="info-paragraph" style="display:none;font-weight:500; color:#3a9efd;font-size:12px;cursor:pointer;" onclick="toggleInfo()">Info</p>
                    </div>
                    <img src="{{asset('/images/pending.png')}}" alt="Pending Image" style="width:40%; margin:0 auto;">
                    <p style="color:#778899; font-size:12px; font-weight:500;  text-align:center;">You have no Restricted Holiday balance, as per our record.</p>
                </div>
            </div>
        </div>
        <div class="row" id="leaveCancel" style="width:80%;margin-top:20px;display: none; margin-left:100px;">

            <div>@livewire('leave-cancel')</div>
        </div>

        <div class="row" id="compOff" style="width:80%; margin-top:20px;display: none; margin-left:100px;">
            <div>
                <div>
                    <div class="leave-pending" style=" background:#fff;  display:flex;  width:100%;flex-direction:column;justify-content:center; border:1px solid #ccc; padding:20px;gap:10px;">
                        <div class="hide-info" style="display:flex; flex-direction:row;background:#FFFFF2;gap:50px; padding:5px 10px;font-size:0.725rem; text-align:start;align-items:center;">
                            <p>Compensatory Off is additional leave granted as a compensation for working overtime or on an off day.</p>
                            <p onclick="toggleInfo()" style="font-weight:500; color:#3a9efd;">Hide</p>
                        </div>
                        <div style="display:flex; justify-content:space-between;">
                            <p style="color:#333; font-size:0.95rem; font-weight:500;text-align:start; ">Applying for Comp. Off Grant</p>
                            <p class="info-paragraph" style="font-weight:500; color:#3a9efd;" onclick="toggleInfo()">Info</p>
                        </div>
                        <img src="{{asset('/images/pending.png')}}" alt="Pending Image" style="width:40%; margin:0 auto;">
                        <p style="color:#778899; font-size:0.825rem; font-weight:500;  text-align:center;">You are not eligible to request for compensatory off grant. Please contact your HR for further information.</p>
                    </div>
                </div>
            </div>
        </div>


        {{-- Apply Tab --}}
        <div class="row" id="personalDetails" style=" margin-top:20px;display: none; margin:0 auto;">
            <div>@livewire('leave-apply')</div>
        </div>

        {{-- pending --}}
        <div class="row" style="margin-top:20px;border-radius: 5px;display: none;" id="accountDetails">

            @if($this->leavePending->isNotEmpty())

            @foreach($this->leavePending as $leaveRequest)

            <div class="leave-container rounded mt-4">

                <div class="pending-accordion rounded" style=" border: 1px solid #ccc;margin-bottom: 10px;font-family: 'Montserrat', sans-serif;width: 90%;  margin: 0 auto;">

                    <div class="pending-accordion-heading rounded" style=" background-color: #fff;padding: 7px;cursor: pointer;" onclick="toggleAccordion(this)">

                        <div class="pending-accordion-title" style=" display: flex;flex-direction: row;justify-content: space-between;">

                            <!-- Display leave details here based on $leaveRequest -->

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="color: #778899; font-size: 12px; font-weight: 500;">Category</span>

                                <span style="color: #36454F; font-size: 12px; font-weight: 500;">Leave</span>

                            </div>

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="color: #778899; font-size: 12px; font-weight: 500;" >Leave Type</span>

                                <span style="color: #36454F; font-size: 12px; font-weight: 500;">{{ $leaveRequest->leave_type}}</span>

                            </div>

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="color: #778899; font-size: 12px; font-weight: 500;">No. of Days</span>

                                <span style="color: #36454F; font-size: 12px; font-weight: 500;">

                                    {{ $this->calculateNumberOfDays($leaveRequest->from_date, $leaveRequest->from_session, $leaveRequest->to_date, $leaveRequest->to_session) }}

                                </span>

                            </div>


                            <!-- Add other details based on your leave request structure -->

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="margin-top:0.625rem; font-size: 12px; font-weight: 400; color:#cf9b17;">{{ strtoupper($leaveRequest->status) }}</span>

                            </div>

                            <div class="arrow-btn" style="color:#778899;height:22px; width:22px; display:flex;justify-content:center;align-items:center; border-radius:50%;border: 1px solid #DCDCDC;">
                                 <i class="fa fa-angle-down"></i>
                            </div>

                        </div>

                    </div>

                    <div class="pending-accordion-body p-0" style="display: none;background-color: #fff;">

                        <div style="width:100%; height:1px; border-bottom:1px solid #ccc; margin-bottom:10px;"></div>

                        <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                            <span style="color: #778899; font-size:11px; font-weight: 500;">Duration:</span>

                            <span style="font-size:10px;">

                                <span style="font-size:10px; font-weight: 500;">{{ $leaveRequest->formatted_from_date }} </span>

                                ( {{ $leaveRequest->from_session }} )to

                                <span style="font-size:10px; font-weight: 500;">{{ $leaveRequest->formatted_to_date }}</span>

                                ( {{ $leaveRequest->to_session }} )

                            </span>

                        </div>

                        <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                            <span style="color: #778899; font-size: 11px; font-weight: 500;">Reason:</span>

                            <span style="font-size: 10px;">{{ ucfirst($leaveRequest->reason) }}</span>

                        </div>

                        <div style="width:100%; height:1px; border-bottom:1px solid #ccc; margin-bottom:10px;"></div>

                        <div style="display:flex; flex-direction:row; justify-content:space-between;">

                            <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                                <span style="color: #778899; font-size: 11px; font-weight: 400;">Applied on:</span>

                                <span style="color: #333; font-size: 10px; font-weight: 500;">{{ $leaveRequest->created_at->format('d M, Y') }}</span>

                            </div>

                            <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                                <a href="{{ route('leave-history', ['leaveRequestId' => $leaveRequest->id]) }}">

                                    <span style="color: #3a9efd; font-size: 12px; ">View Details</span>

                                </a>
                                <button class="withdraw" style=" background: #3a9efd;border: none;font-size:12px;padding: 2px 5px;color: white;font-weight: 500; border-radius: 5px;"wire:click="cancelLeave({{ $leaveRequest->id }})">Withdraw</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

            @else

            <div class="leave-pending" style="margin-top:30px; background:#fff; margin-left:120px; display:flex; width:75%;flex-direction:column; text-align:center;justify-content:center; border:1px solid #ccc; padding:20px;gap:10px;">

                <img src="{{asset('/images/pending.png')}}" alt="Pending Image" style="width:60%; margin:0 auto;">

                <p style="color:#969ea9; font-size:13px; font-weight:400; ">There are no pending records of any leave transaction</p>

            </div>

            @endif

        </div>



        {{-- history --}}

        <div class="row" style="margin-top:20px;border-radius: 5px;display: none;" id="familyDetails">
            @if($this->leaveRequests->isNotEmpty())

            @foreach($this->leaveRequests->whereIn('status', ['approved', 'rejected','Withdrawn']) as $leaveRequest)

            <div class="pending-leaves rounded mt-4">

                <div class="pending-accordion rounded" style=" border: 1px solid #ccc;margin-bottom: 10px;font-family: 'Montserrat', sans-serif;width: 90%;  margin: 0 auto;">

                    <div class="pending-accordion-heading rounded" style=" background-color: #fff;padding: 7px;cursor: pointer;" onclick="toggleAccordion(this)">

                        <div class="pending-accordion-title rounded" style=" display: flex;flex-direction: row;justify-content: space-between;">

                            <!-- Display leave details here based on $leaveRequest -->

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="color: #778899; font-size: 12px; font-weight: 500;">Category</span>

                                <span style="color: #36454F; font-size: 12px; font-weight: 500;">Leave</span>

                            </div>

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="color: #778899; font-size: 12px; font-weight: 500;">Leave Type</span>

                                <span style="color: #36454F; font-size: 12px; font-weight: 500;">{{ $leaveRequest->leave_type}}</span>

                            </div>

                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                <span style="color: #778899; font-size: 12px; font-weight: 500;">No. of Days</span>

                                <span style="color: #36454F; font-size: 12px; font-weight: 500;">

                                    {{ $this->calculateNumberOfDays($leaveRequest->from_date, $leaveRequest->from_session, $leaveRequest->to_date, $leaveRequest->to_session) }}

                                </span>

                            </div>



                            <!-- Add other details based on your leave request structure -->



                            <div class="pending-accordion-content" style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">

                                @if(strtoupper($leaveRequest->status) == 'APPROVED')

                                <span style="margin-top:0.625rem; font-size: 12px; font-weight: 500; color:#32CD32;">{{ strtoupper($leaveRequest->status) }}</span>

                                @elseif(strtoupper($leaveRequest->status) == 'REJECTED')

                                <span style="margin-top:0.625rem; font-size: 12px; font-weight: 500; color:#FF0000;">{{ strtoupper($leaveRequest->status) }}</span>

                                @else

                                <span style="margin-top:0.625rem; font-size: 12px; font-weight: 500; color:#778899;">{{ strtoupper($leaveRequest->status) }}</span>

                                @endif

                            </div>

                            <div class="arrow-btn" style="color:#778899;height:22px; width:22px; display:flex;justify-content:center;align-items:center; border-radius:50%;border: 1px solid #DCDCDC;" >
                                 <i class="fa fa-angle-down"></i>
                            </div>

                        </div>

                    </div>

                    <div class="pending-accordion-body p-0" style="display: none;background-color: #fff;">

                        <div style="width:100%; height:1px; border-bottom:1px solid #ccc; margin-bottom:10px;"></div>

                        <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                            <span style="color: #778899; font-size:12px; font-weight: 500;">Duration:</span>

                            <span style="font-size:10px;">

                                <span style="font-size:10px; font-weight: 500;">{{ $leaveRequest->formatted_from_date }}</span>

                                ({{ $leaveRequest->from_session }} ) to

                                <span style="font-size:10px; font-weight: 500;">{{ $leaveRequest->formatted_to_date }}</span>

                                ( {{ $leaveRequest->to_session }} )

                            </span>

                        </div>

                        <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                            <span style="color: #778899; font-size:12px; font-weight: 500;">Reason:</span>

                            <span style="font-size:10px;">{{ ucfirst($leaveRequest->reason) }}</span>

                        </div>

                        <div style="width:100%; height:1px; border-bottom:1px solid #ccc; margin-bottom:10px;"></div>

                        <div style="display:flex; flex-direction:row; justify-content:space-between;">

                            <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                                <span style="color: #778899; font-size: 12px; font-weight: 400;">Applied on:</span>

                                <span style="color: #333; font-size: 12px; font-weight: 500;">{{ $leaveRequest->created_at->format('d M, Y') }}</span>

                            </div>

                            <div class="pending-content px-2" style=" display: flex;justify-content: start;align-items: center;gap: 7px;margin-bottom: 5px;">

                                <a href="{{ route('leave-pending', ['leaveRequestId' => $leaveRequest->id]) }}">
                                    <span style="color: #3a9efd; font-size: 12px; font-weight: 500;">View Details</span>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            @endforeach

            @else

            <div class="leave-pending" style="margin-top:30px; background:#fff; margin-left:120px; display:flex; width:75%;flex-direction:column; text-align:center;justify-content:center; border:1px solid #ccc; padding:20px;gap:10px;">

                <img src="{{asset('/images/pending.png')}}" alt="Pending Image" style="width:60%; margin:0 auto;">

                <p style="color:#969ea9; font-size:13px; font-weight:400; ">There are no history records of any leave transaction</p>

            </div>

            @endif

        </div>

    </div>
</div>

<script>
    function toggleInfo() {
        const hideInfoDiv = document.querySelector('.hide-info');
        const infoParagraph = document.querySelector('.info-paragraph');

        hideInfoDiv.style.display = (hideInfoDiv.style.display === 'none' || hideInfoDiv.style.display === '') ? 'flex' : 'none';
        infoParagraph.style.display = (infoParagraph.style.display === 'none' || infoParagraph.style.display === '') ? 'block' : 'none';
    }

    function toggleDetails(sectionId, clickedLink) {

        const links = document.querySelectorAll('.custom-nav-link');
        links.forEach(link => link.classList.remove('active'));

        clickedLink.classList.add('active');
        const tabs = ['leave', 'accountDetails', 'familyDetails'];
        tabs.forEach(tab => {
            const tabElement = document.getElementById(tab);
        tabElement.style.display = tab === sectionId ? 'block' : 'none';
        });
        // Hide the content of other containers
        const otherContainers = ['restricted', 'leaveCancel', 'compOff'];
        otherContainers.forEach(container => {
            const containerElement = document.getElementById(container);
            containerElement.style.display = 'none';
        });
        // Hide the 'side' container when 'pending' or 'history' is clicked
        const sideContainer = document.getElementById('cardElement');
        if (sectionId === 'accountDetails' || sectionId === 'familyDetails') {
            sideContainer.style.display = 'none';
        } else {
            sideContainer.style.display = 'flex';
            sideContainer.style.flexDirection = 'row'
            toggleOptions('leave', document.querySelector('.side a[data-section="leave"]'));
        }
      

    }



    function toggleAccordion(element) {

        const accordionBody = element.nextElementSibling;

        if (accordionBody.style.display === 'block') {

            accordionBody.style.display = 'none';

            element.classList.remove('active'); // Remove active class

        } else {

            accordionBody.style.display = 'block';

            element.classList.add('active'); // Add active class

        }
    }
document.addEventListener('DOMContentLoaded', function() {
    // Get the default link for 'leave'
    const defaultLink = document.querySelector('.side a[data-section="leave"]');
    
    // Call toggleOptions with 'leave' and the default link
    toggleOptions('leave', defaultLink);
});

function toggleOptions(sectionId, clickedLink) {
    const tabs = ['leave', 'restricted', 'leaveCancel', 'compOff'];

        const links = document.querySelectorAll('.side a');
        links.forEach(link => link.classList.remove('active'));

        clickedLink.classList.add('active');

        tabs.forEach(tab => {
            const tabElement = document.getElementById(tab);
            if (tab === sectionId) {
                tabElement.style.display = 'block';
            } else {
                tabElement.style.display = 'none';
            }
        });

    // Hide the content of other containers
    const otherContainers = ['accountDetails', 'familyDetails'];
    otherContainers.forEach(container => {
        const containerElement = document.getElementById(container);
        containerElement.style.display = 'none';
    });
}




</script>
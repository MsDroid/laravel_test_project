@extends('layouts.applicant_app')
@section('content')
<div class="container">
  <h3>Applicant Dashboard</h3>
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  @if($applicant->current_step == 4 && $applicant->submitted ==1 && $applicant->status == 'pending')
<div class="alert alert-info">
            ✅ Your application has been submitted and is currently <strong>{{ ucfirst($applicant->status) }}</strong>.
        </div>
        @elseif ($applicant->registration_no)
    <div class="alert alert-success">
        🎉 Congratulations! Your application is approved.  
        Your Registration No: <strong>{{ $applicant->registration_no }}</strong><br>
        <a href="{{ Storage::url($applicant->final_pdf) }}" target="_blank">Download Registration PDF</a>
    </div>
  @else
  <ul class="nav nav-tabs" id="stepTabs">
    <li class="nav-item">
        <a class="nav-link {{ $applicant->current_step == 1 ? 'active' : 'disabled' }}" 
           href="#step1" data-bs-toggle="tab">Step 1: Payment</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $applicant->current_step == 2 ? 'active' : 'disabled' }}" 
           href="#step2" data-bs-toggle="tab">Step 2: Personal & Education</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $applicant->current_step == 3 ? 'active' : 'disabled' }}" 
           href="#step3" data-bs-toggle="tab">Step 3: Documents</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $applicant->current_step == 4 ? 'active' : 'disabled' }}" 
           href="#step4" data-bs-toggle="tab">Step 4: Preview & Submit</a>
    </li>
  </ul>



  <div class="tab-content mt-3">
    {{-- Step 1 --}}
    <div class="tab-pane {{ $applicant->current_step == 1 ? 'active' : ''}}" id="step1">
      
       @if($applicant->already_applied)

          <div class="alert alert-info">
        You have already applied in Advt. No. 01/2024. Payment is not required again.
        </div>
        @else
            <form action="{{ route('applicant.payment') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label>Bank</label><input name="bank_name" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Amount</label>
                <input name="amount" id="amountInput" class="form-control" readonly>
              </div>
              <div class="mb-3">
                <label>Payment Ref No</label><input name="payment_ref" class="form-control" required>
              </div>
              <div class="mb-3"><label>Dated</label><input type="date" name="payment_date" class="form-control" required></div>
              <div class="mb-3"><label>Upload Receipt</label><input type="file" name="receipt_path" class="form-control" accept=".pdf,.jpg,.png" required></div>
              <button class="btn btn-primary">Save Payment</button>
            </form>
          @endif
    </div>

    {{-- Step 2 --}}
    <div class="tab-pane {{ $applicant->current_step == 2 ? 'active' : ''}}" id="step2">
      @php $disabled = session('profileUpdated') ? 'disabled' : ''; @endphp
      <form action="{{ route('applicant.personal') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="name" class="form-control" 
               value="{{ $applicant->full_name }}" {{ $disabled }}>
    </div>

    <div class="mb-3">
        <label>Date of Birth</label>
        <input type="text" name="dob" class="form-control" 
               value="{{ $applicant->dob }}" {{ $disabled }}>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="text" name="age" class="form-control" 
               value="{{ \Carbon\Carbon::parse($applicant->dob)->age }} yrs" {{ $disabled }}>
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <input type="text" name="gender" class="form-control" 
               value="{{ $applicant->gender }}" {{ $disabled }}>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" class="form-control" 
               value="{{ $applicant->category }}" {{ $disabled }}>
    </div>

    <div class="mb-3">
      
        <label>Category Certificate Number</label>
        <input type="text" name="category_certificate_no" 
               class="form-control @error('category_certificate_no') is-invalid @enderror" 
               value="{{ old('category_certificate_no',$applicant->category_certificate_no ) }}" required {{ $disabled }}>
        @error('category_certificate_no')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control @error('address') is-invalid @enderror" required {{ $disabled }}>{{ old('address',$applicant->address ) }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Photo ID Type</label>
        <select name="photo_id_type" class="form-control @error('photo_id_type') is-invalid @enderror" required {{ $disabled }}>
            <option value="">-- Select ID --</option>
            <option value="Aadhaar" {{ old('photo_id_type',$applicant->photo_id_type ) == 'Aadhaar' ? 'selected' : '' }}>Aadhaar</option>
            <option value="PAN" {{ old('photo_id_type', $applicant->photo_id_type) == 'PAN' ? 'selected' : '' }}>PAN</option>
        </select>
        @error('photo_id_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Photo ID No</label>
        <input type="text" name="photo_id_no" 
               class="form-control @error('photo_id_no') is-invalid @enderror" 
               value="{{ old('photo_id_no',$applicant->photo_id_no ) }}" required {{ $disabled }}>
        @error('photo_id_no')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Upload ID Photo</label>
         {{-- Show uploaded image if exists --}}
    @if(!empty($applicant->photo_id_image))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $applicant->photo_id_image) }}" 
                 alt="Uploaded ID" 
                 class="img-thumbnail" 
                 style="max-height: 150px;">
        </div>
    @endif
        <input type="file" name="photo_id_image" 
               class="form-control @error('photo_id_image') is-invalid @enderror" required>
        @error('photo_id_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      
    </div>

    <button class="btn btn-primary">Save Personal Info</button>
      </form>


            <hr>

              @php
                $isAgriculture = $applicant->subject == "Agriculture";
                $msg = (bool) $isAgriculture ? "B.Ed is Compulsury for Subject (Agriculture)" : "";
              @endphp
            <h5>Educational Info <span style="color: red;font-size: 10px;word-spacing: 1.5px;">{{$msg}}</span></h5>
            <div>
          <div class="row eduRow mb-2 fw-bold text-center bg-light p-2 rounded">
              <div class="col-md-2">
                  Education Level
              </div>
              <div class="col-md-2">
                  Board / University
              </div>
              <div class="col-md-2">
                  Passing Year
              </div>
              <div class="col-md-2">
                  Subject
              </div>
              <div class="col-md-1">
                  Marks Obtained
              </div>
              <div class="col-md-1">
                  Division
              </div>
              <div class="col-md-2">
                  Certificate No.
              </div>
          </div>
      </div>

      <form action="{{ route('applicant.education') }}" method="POST" id="educationForm">

            @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @csrf
            @php
              $levels = ['10th', '12th', 'Graduation', 'Post-Graduation', 'B.Ed'];
            @endphp
          <div id="eduRows">
            @foreach ($levels as $index => $level)
                <div class="row eduRow mb-2">
                    <div class="col-md-2">
                      <input name="educations[{{ $index }}][level]" 
                            class="form-control" 
                            value="{{ $level }}" 
                            readonly >
                    </div>
                    <div class="col-md-2">
                      <input name="educations[{{ $index }}][board_university]" 
                            class="form-control" 
                            placeholder="Board/University"
                            @if($isAgriculture && $level == 'B.Ed') required @endif 
                            value="{{ old("educations.$index.board_university") }}">
                            @error("educations.$index.board_university")
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="col-md-2">
                      <input name="educations[{{ $index }}][year_of_passing]" 
                            class="form-control" 
                            placeholder="Passing Year"
                            @if($isAgriculture && $level == 'B.Ed') required @endif
                        value="{{ old("educations.$index.year_of_passing") }}" >
                            @error("educations.$index.year_of_passing")
                          <div class="invalid-feedback">{{ $message }}</div>

                        @enderror
                    </div>

                    <div class="col-md-2">
                      <input name="educations[{{ $index }}][subjects]" 
                            class="form-control" 
                            placeholder="Subject"
                            @if($isAgriculture && $level == 'B.Ed') required @endif
                        value="{{ old("educations.$index.subjects") }}" >
                            @error("educations.$index.subjects")
                          <div class="invalid-feedback">{{ $message }}</div>

                        @enderror
                    </div>


                    <div class="col-md-1">
                      <input name="educations[{{ $index }}][marks_obtained]" 
                            class="form-control marks" 
                            placeholder="Marks"
                            @if($isAgriculture && $level == 'B.Ed') required @endif
                        value="{{ old("educations.$index.marks_obtained") }}" >
                          @error("educations.$index.marks_obtained")
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="col-md-1">
                      <input name="educations[{{ $index }}][division]" 
                            class="form-control division" 
                            placeholder="Division"
                            @if($isAgriculture && $level == 'B.Ed') required @endif
                        value="{{ old("educations.$index.division") }}" readonly>
                        @error("educations.$index.division")
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="col-md-2">
                      <input name="educations[{{ $index }}][certificate_no]" 
                            class="form-control" 
                            placeholder="Certificate No."
                            @if($isAgriculture && $level == 'B.Ed') required @endif
                        value="{{ old("educations.$index.certificate_no") }}" >
                        @error("educations.$index.certificate_no")
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
              </div>
            @endforeach
          </div>
        <button type="button" id="addEdu" class="btn btn-secondary">Add Education Row</button>
        <button class="btn btn-primary">Save Education</button>
      </form>

      {{-- experience form --}}
      <h4 class="mt-3">Work Experience</h4>
      <form action="{{ route('applicant.experience')}}" method="POST" id="experienceForm">
        @csrf
      <div id="experienceRows">
        <div class="row mb-2 expRow">
          <div class="col-md-2">
            <input type="text" name="experiences[0][institution]" class="form-control" placeholder="Institution">
          </div>
          <div class="col-md-2">
            <input type="text" name="experiences[0][designation]" class="form-control" placeholder="Designation">
          </div>
          <div class="col-md-2">
            <input type="date" name="experiences[0][from]" class="form-control fromDate">
          </div>
          <div class="col-md-2">
            <input type="date" name="experiences[0][to]" class="form-control toDate">
          </div>
          <div class="col-md-2">
            <input type="text" name="experiences[0][total_period]" class="form-control totalPeriod" placeholder="Total Period" readonly>
          </div>
          <div class="col-md-2">
            <input type="text" name="experiences[0][subjects_taught]" class="form-control" placeholder="Subjects Taught">
          </div>
          <div class="col-md-2 mt-2">
            <select name="experiences[0][status]" class="form-control">
              <option value="current">Current</option>
              <option value="previous">Previous</option>
            </select>
          </div>
        </div>
        <button type="button" id="addExpRow" class="btn btn-secondary">Add Experience Row</button>
        {{-- <button type="button" class="btn btn-sm btn-success mt-2" id="addExpRow">+ Add Row</button> --}}
        <button class="btn btn-primary">Save Experience</button>
      </div>
    </form>
      

    </div>

    {{-- Step 3 --}}
    <div class="tab-pane {{ $applicant->current_step == 3 ? 'active' : ''}}" id="step3">
      <form action="{{ route('applicant.documents') }}" method="POST" enctype="multipart/form-data" id="docForm">
        @csrf
       <div id="docRows">
          @php
          $applicant = auth()->user()->applicant()->with('educations')->firstOrFail();
              $validEducations = $applicant->educations->filter(function($edu) {
                  return !empty($edu->board_university) && !empty($edu->year_of_passing) && !empty($edu->subjects);
              });
          @endphp

          @foreach($validEducations as $i => $edu)
              <div class="row mb-2 docRow">
                  <div class="col-md-3">
                      <select name="documents[{{ $i }}][type]" class="form-control">
                          <option value="photo">Photo</option>
                          <option value="signature">Signature</option>
                          <option value="dob_proof">DOB Proof</option>
                          <option value="caste_certificate">Caste Certificate</option>
                          <option value="10th" {{ $edu->level == '10th' ? 'selected' : '' }}>10th</option>
                          <option value="12th" {{ $edu->level == '12th' ? 'selected' : '' }}>12th</option>
                          <option value="Graduate" {{ $edu->level == 'Graduation' ? 'selected' : '' }}>Graduate</option>
                          <option value="Post-Graduation" {{ $edu->level == 'Post-Graduation' ? 'selected' : '' }}>Post-Graduation</option>
                          <option value="B.Ed" {{ $edu->level == 'B.Ed' ? 'selected' : '' }}>B.Ed</option>
                          <option value="emp1">Employment-1</option>
                          <option value="emp2">Employment-2</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <input name="documents[{{ $i }}][file]" type="file" class="form-control" required>
                  </div>
              </div>
          @endforeach
        </div>

        <button type="button" id="addDoc" class="btn btn-secondary">Add Document</button>
        <button class="btn btn-primary">Upload Documents</button>
      </form>


      
    </div>

    {{-- Step 4 --}}
    <div class="tab-pane {{ $applicant->current_step == 4 ? 'active' : ''}}" id="step4">
      <h5>Preview</h5>
      <a href="{{ route('applicant.preview', $applicant->id) }}" class="btn btn-info">Open Preview</a>
      <form action="{{ route('applicant.submit') }}" method="POST" class="mt-3">
        @csrf
        <button class="btn btn-success">Final Submit</button>
      </form>
    </div>
  </div>
  @endif
</div>

<script>
(function(){
  // set amount based on category
  const category = @json($applicant->category ?? 'General');
  const amountInput = document.getElementById('amountInput');
  const computeAmount = (cat, already) => {
    if(already) return 0;
    if(cat === 'General') return 1000;
    return 500;
  };
  amountInput.value = computeAmount(category, @json($applicant->already_applied?1:0));

  // add education rows
  let eduIndex = 1;
  document.getElementById('addEdu').addEventListener('click', function(){
    const container = document.getElementById('eduRows');
    const node = document.querySelector('.eduRow').cloneNode(true);
    node.querySelectorAll('input').forEach(i=>{
      const name = i.getAttribute('name');
      i.setAttribute('name', name.replace(/\d+/, eduIndex));
      i.value = '';
    });
    container.appendChild(node);
    eduIndex++;
  });

  // compute division on marks change
  document.addEventListener('input', function(e){
    if(e.target.matches('.marks') || e.target.matches('.totalMarks')){
      const row = e.target.closest('.eduRow');
      const marks = parseInt(row.querySelector('.marks').value || 0);
      const total = parseInt(row.querySelector('.totalMarks').value || 0);
      if(total>0){
        const percent = (marks/total)*100;
        // optionally display percent (omitted for brevity)
      }
    }
  });

  // add document rows
  let docIndex = 1;
  document.getElementById('addDoc').addEventListener('click', function(){
    const container = document.getElementById('docRows');
    const node = document.querySelector('.docRow').cloneNode(true);
    node.querySelectorAll('select,input[type=file]').forEach((el)=>{
      const name = el.getAttribute('name');
      el.setAttribute('name', name.replace(/\d+/, docIndex));
      el.value = '';
    });
    container.appendChild(node);
    docIndex++;
  });


  /// auto calculate division
  function calculateDivision(marks) {
        let percentage = (marks / 500) * 100;
        if (percentage >= 60) return "First";
        else if (percentage >= 45) return "Second";
        else if (percentage >= 33) return "Third";
        else return "Fail";
    }

    // Attach event listener to marks input
    document.querySelectorAll(".marks").forEach(function (input) {
        input.addEventListener("input", function () {
            let marks = parseInt(this.value) || 0;
            let row = this.closest(".eduRow");
            let divisionField = row.querySelector(".division");

            divisionField.value = calculateDivision(marks);
        });
    });


    // experience
    
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('fromDate') || e.target.classList.contains('toDate')) {
        let row = e.target.closest('.expRow');
        let fromDate = row.querySelector('.fromDate').value;
        let toDate   = row.querySelector('.toDate').value;

        if (fromDate && toDate) {
            let from = new Date(fromDate);
            let to   = new Date(toDate);

            let years = to.getFullYear() - from.getFullYear();
            let months = to.getMonth() - from.getMonth();

            if (months < 0) {
                years--;
                months += 12;
            }

            row.querySelector('.totalPeriod').value = 
                `${years > 0 ? years + ' Yr ' : ''}${months} Mo`;
        }
    }
});

// Add new experience row
document.getElementById('addExpRow').addEventListener('click', function () {
    let rows = document.querySelectorAll('#experienceRows .expRow');
    let i = rows.length;

    let newRow = `
      <div class="row mb-2 expRow">
        <div class="col-md-2"><input type="text" name="experiences[${i}][institution]" class="form-control" placeholder="Institution"></div>
        <div class="col-md-2"><input type="text" name="experiences[${i}][designation]" class="form-control" placeholder="Designation"></div>
        <div class="col-md-2"><input type="date" name="experiences[${i}][from]" class="form-control fromDate"></div>
        <div class="col-md-2"><input type="date" name="experiences[${i}][to]" class="form-control toDate"></div>
        <div class="col-md-2"><input type="text" name="experiences[${i}][total_period]" class="form-control totalPeriod" readonly></div>
        <div class="col-md-2"><input type="text" name="experiences[${i}][subjects_taught]" class="form-control" placeholder="Subjects Taught"></div>
        <div class="col-md-2 mt-2">
          <select name="experiences[${i}][status]" class="form-control">
            <option value="current">Current</option>
            <option value="previous">Previous</option>
          </select>
        </div>
      </div>`;
    
    document.getElementById('experienceRows').insertAdjacentHTML('beforeend', newRow);
});


    

})();
</script>
@endsection

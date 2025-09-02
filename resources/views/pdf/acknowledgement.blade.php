<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Acknowledgement Slip</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h3 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h3>Application Acknowledgement Slip</h3>
    <p><strong>Acknowledgement No:</strong> {{ $ack->ack_no }}</p>
    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p><strong>Submitted At:</strong> {{ $applicant->submitted_at }}</p>

    

    <h4>Personal Details</h4>
    <p><strong>DOB:</strong> {{ $applicant->dob }} | <strong>Gender:</strong> {{ $applicant->gender }}</p>

    {{-- payment details --}}
    <h4>Bank Details</h4>
    <table>
        <thead>
            <tr>
                <th>Bank</th><th>Amount</th><th>Payment Reference</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($applicant->payments as $pay)
                <tr>
                    <td>{{ $pay->bank_name ?? '-'}}</td>
                    <td>{{ $pay->amount ?? '-'}}</td>
                    <td>{{ $pay->payment_ref ?? '-' }}</td>
                    <td>{{ $pay->payment_date ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Education</h4>
    <table>
        <thead>
            <tr>
                <th>Level</th><th>Board/University</th><th>Year</th><th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicant->educations as $edu)
                <tr>
                    <td>{{ $edu->level }}</td>
                    <td>{{ $edu->board_university }}</td>
                    <td>{{ $edu->year }}</td>
                    <td>{{ $edu->marks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Experience</h4>
    <table>
        <thead>
            <tr>
                <th>Institution</th><th>Designation</th><th>Period</th><th>Total Period</th><th>Subject Taught</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicant->experiences as $exp)
                <tr>
                    <td>{{ $exp->institution }}</td>
                    <td>{{ $exp->designation }}</td>
                    <td>{{ $exp->from_date }} to {{ $exp->to_date }}</td>
                    <td>{{ $exp->total_period }}</td>
                    <td>{{ $exp->subjects_taught }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Uploaded Document</h4>
    <table>
        <thead>
            <tr>
                <th>Document</th><th>Uploaded</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicant->documents as $doc)
                <tr>
                    <td>{{ $doc->type }}</td>
                    <td>✔ Uploaded</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top:20px;"><em>This slip is system-generated and does not require a signature.</em></p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Acknowledgement</title>
</head>
<body>
    <p>Dear {{ $applicant->full_name }},</p>

    <p>Thank you for submitting your application.</p>

    <p>Your acknowledgement number is: <strong>{{ $ack->ack_no }}</strong></p>

    <p>A copy of your acknowledgement slip has been attached as a PDF.</p>

    <p>Best regards,<br>
    Recruitment Team</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Matching Resumes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dddddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Matching Resumes</h1>
    <p>Dear HR,</p>
    <p>Here are the Resumes that match your search query:</p>

    <table>
        <thead>
            <tr>
                <th>Resume Name</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cvList as $cv)
            <tr>
                <td>{{ $cv['fileName'] }}</td>
                <td>{{ $cv['uploadedTime'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>Thank you for using our website.</p>
    <p>Best Regards,</p>
    <p>Your Company HR Team</p>
</body>
</html>

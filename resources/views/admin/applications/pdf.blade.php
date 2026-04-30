<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Applications Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; }
        h1 { text-align: center; color: #333; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f39c12; color: white; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .header { text-align: center; margin-bottom: 20px; }
        .date { text-align: right; color: #666; margin-bottom: 10px; }
        .status-submitted { color: #f39c12; font-weight: bold; }
        .status-approved { color: #28a745; font-weight: bold; }
        .status-rejected { color: #dc3545; font-weight: bold; }
        .status-under_review { color: #17a2b8; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ibn Sina Foundation</h1>
        <h2>Applications Report</h2>
    </div>
    
    <div class="date">
        Generated on: {{ date('F d, Y h:i A') }}
    </div>

    <p><strong>Total Applications:</strong> {{ $applications->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>Application ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>Status</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $app)
            <tr>
                <td>{{ $app->application_id }}</td>
                <td>{{ $app->full_name }}</td>
                <td>{{ $app->email }}</td>
                <td>{{ $app->phone }}</td>
                <td>{{ $app->country }}</td>
                <td class="status-{{ $app->status }}">{{ ucfirst($app->status) }}</td>
                <td>{{ $app->submission_date ? $app->submission_date->format('M d, Y') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

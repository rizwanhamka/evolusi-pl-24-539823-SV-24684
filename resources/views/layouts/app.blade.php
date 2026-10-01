<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Catatan')</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 24px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
        }

        h1 {
            margin-top: 0;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .button-secondary {
            background: #64748b;
        }

        .button-danger {
            background: #dc2626;
        }

        .button-success {
            background: #16a34a;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
        }

        textarea {
            min-height: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            margin: 16px 0;
            border-radius: 6px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .status {
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .container {
                margin: 12px;
                padding: 16px;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>

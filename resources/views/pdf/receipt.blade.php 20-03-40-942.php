<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installment Receipt</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Installment Receipt for {{ auth()->user()->name }}</h2>

    <table>
        <thead>
            <tr>
                <th>Installment Number</th>
                <th>Date</th>
                <th>Payment Amount</th>
                <th>Interest</th>
                <th>Collection Fee</th>
                <th>Principal Return</th>
                <th>Remaining Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($installments as $installment)
                <tr>
                    <td>{{ $installment->installment_number }}</td>
                    <td>{{ $installment->date }}</td>
                    <td>{{ number_format($installment->payment_amount, 2) }}</td>
                    <td>{{ number_format($installment->interest, 2) }}</td>
                    <td>{{ number_format($installment->collection_fee, 2) }}</td>
                    <td>{{ number_format($installment->principal_return, 2) }}</td>
                    <td>{{ number_format($installment->remaining_balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Thank you for using our service!</p>
</body>
</html>

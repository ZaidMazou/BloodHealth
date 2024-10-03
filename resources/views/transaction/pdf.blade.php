<!DOCTYPE html>
<html>

<head>
    <title>Liste des Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Transactions du {{ $start_date ?? 'début' }} au {{ $end_date ?? 'maintenant' }}</h1>

    <table>
        <thead>
            <tr>
                <th>Admin</th>
                <th>Hôpital</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Motif</th>
                <th>Date de Transaction</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->adminUser->name }}</td>
                    <td>{{ $transaction->hospital->name }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->quantite }}</td>
                    <td>{{ $transaction->motif_transaction }}</td>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr> Aucune données</tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

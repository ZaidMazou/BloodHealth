@extends('admin.Layout')

@section('title','Statistiques')

@section('content')
    <div class="row">
        <!-- Users Count -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    Total Users
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $userscount }}</h5>
                    <p class="card-text">Total number of users admin.</p>
                </div>
            </div>
        </div>

        <!-- Hospitals Count -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    Total Hospitals
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $hospital }}</h5>
                    <p class="card-text">Total number of hospitals.</p>
                </div>
            </div>
        </div>

        <!-- Total Blood Quantity -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    Total Blood Quantity
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $blood }}</h5>
                    <p class="card-text">Total quantity of blood pockets available.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Blood Type Distribution Chart -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Nombre de poche de sang disponible par groupe sanguin
                </div>
                <div class="card-body">
                    <canvas id="bloodTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Liste des transactions</h5>
    
            <div class="card-header-right">
                <a href="{{ route('transactions/pdf')}}">
                    <i class="fa fa-download"></i>
                </a>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admin</th>
                            <th>Hôpital</th>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Groupe sanguin</th>
                            <th>Motif</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $transaction->id }}</th>
                                <td>{{ $transaction->adminUser->name }}</td>
                                <td>{{ $transaction->hospital->name }}</td>
                                <td>
                                    @if ($transaction->type === 'Ajout')
                                        <label class="badge badge-success">Ajout</label>
                                    @else
                                        <label class="badge badge-danger">Retrait</label>
                                    @endif
                                </td>
                                <td>{{ $transaction->quantite }}</td>
                                <td>{{ $transaction->group_sanguin }}</td>
                                <td>{{ strtr($transaction->motif_transaction, 0, 60) }}</td>
                                <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune transaction</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if ($transactions->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $transactions->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        @endif

                        @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $transactions->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($transactions->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $transactions->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('bloodTypeChart').getContext('2d');
            var bloodTypeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($bloods->pluck('group_sanguin')),
                    datasets: [{
                        label: 'Quantity of Blood',
                        data: @json($bloods->pluck('total')),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection

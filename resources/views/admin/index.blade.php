@extends('admin.Layout')

@section('content')
    @forelse ($blood as $bl)
        @if ($bl->total < 50)
            <div class=" alert alert-danger">
                Le nombre de poche de sang du groupe sanguin {{ $bl->group_sanguin }} est en dessous de 50
            </div>
        @endif
    @empty
        <span></span>
    @endforelse

    <div class=" row">
        @forelse ($blood as $item)
            <div class="col-md-3">
                <div class="card text-center order-visitor-card">
                    <div class="card-block">
                        <h2 class="m-b-0 text-lg">{{ $item->group_sanguin }}</h2>
                        <h4 class="m-t-15 m-b-15">{{ $item->total }}</h4>
                    </div>
                </div>
            </div>
        @empty
            <div class=" alert alert-danger col-lg text-center"> Aucune poche de sang</div>
        @endforelse
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-c-green total-card">
                <div class="card-block">
                    <div class="text-left">
                        <h4>{{ $countblood->total }}</h4>
                        <p class="m-0">Poches de sang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Blood Type Distribution Chart -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Blood Type Distribution
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
                    labels: @json($blood->pluck('group_sanguin')),
                    datasets: [{
                        label: 'Quantity of Blood',
                        data: @json($blood->pluck('total')),
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

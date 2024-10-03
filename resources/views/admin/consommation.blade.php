@extends('admin.Layout')

@section('title','Statistiques des consommations')

@section('content')
    <div class="row mt-5">
        <!-- Blood Type Distribution Chart -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Consommation des poches de sang
                </div>
                <div class="card-body">
                    <canvas id="bloodTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Recherchez de façon précise le nombre de poche de groupe sanguin consommé pour un centre
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.consommation-search')}}" method="get">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="" class=" text-danger">Groupe sanguin</label>
                                <select name="group_sanguin" id="" class="form-control">
                                    <option value="A+">A+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="A-">A-</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="" class=" text-danger">Hopital</label>
                                <select name="hopital" id="" class="form-control">
                                    @forelse ($hospitals as $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @empty
                                        <option value="">aucun hôpital</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="" class="text-danger">Date de debut</label>
                                <input type="date" name="debut" id="" class=" form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="text-danger">Date de debut</label>
                                <input type="date" class="form-control" placeholder="" name="fin">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Recherchez</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('bloodTypeChart').getContext('2d');
            var bloodTypeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($consommation->pluck('group_sanguin')),
                    datasets: [{
                        label: 'Quantity of Blood spended',
                        data: @json($consommation->pluck('total')),
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

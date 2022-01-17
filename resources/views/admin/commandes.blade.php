@extends('layouts.appadmin')

@section('title')
    Commandes
@endsection
{{Form::hidden('', $increment=1)}}
@section('contenu')
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste Commandes</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Nom du Client</th>
                        <th>Adresse</th>
                        <th>Panier</th>
                        <th>Payment ID</th>
                        <th>Actions</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>1</td>
                            <td>2012/08/03</td>
                            <td>2012/08/03</td>
                            <td>2012/08/03</td>
                            <td>2012/08/03</td>
                            <td>
                              <button class="btn btn-outline-primary">View</button>
                            </td>
                        </tr>  

                        {{Form::hidden('', $increment=$increment+1)}}
                    @endforeach
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
    <script src="backend/js/data-table.js"></script> 
@endsection
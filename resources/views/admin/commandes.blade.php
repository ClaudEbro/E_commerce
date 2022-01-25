@extends('layouts.appadmin')

@section('title')
    Commandes
@endsection
{{Form::hidden('', $increment=1)}}
@section('contenu')
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste Commandes</h4>
          @if (Session::has('error'))
                        <div class="alert alert-success">
                            {{Session::get('error')}}
                            {{Session::put('error', null)}}
                        </div>
          @endif
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Nom du client</th>
                        <th>Adresse</th>
                        <th>Panier</th>
                        <th>Payment ID</th>
                        <th>Actions</th>    
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                        <tr>
                          <td>{{$increment}}</td>
                          <td>{{$order->$nom}}</td>
                          <td>{{$order->$adresse}}</td>
                          <td>
                              @foreach ($order->cart->items as $item)
                                 {{$item['product_name'].' , '}}
                              @endforeach
                          </td>
                          <td>{{$order->$payment_id}}</td>
                            <td>
                              <button class="btn btn-outline-primary" onclick="window.location ='{{url('/voir_pdf/'.$order->id)}}'">View</button>
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
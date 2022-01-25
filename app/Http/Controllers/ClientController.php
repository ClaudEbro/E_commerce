<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Client;
use App\Cart;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Stripe\Charge;
use Stripe\Stripe;


class ClientController extends Controller
{

    public function home(){
        $sliders = Slider::where('status', 1)->get();
        $produits = Product::where('status', 1)->get();

        return view('client.home')->with('sliders', $sliders)->with('produits', $produits);
    }

    public function shop(){
        
        $categories = Category::get();
        $produits = Product::where('status',1)->get();
        return view('client.shop')->with('categories', $categories)->with('produits', $produits);
    }

    public function select_par_cat($name){

        $categories = Category::get();
        $produits = Product::where('product_category', $name)->where('status', 1)->get();

        return view('client.shop')->with('produits', $produits)->with('categories', $categories);
    }



    public function ajouter_au_panier($id){

        $product = Product::find($id);

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect('/shop');
    }


    public function modifier_panier(Request $request, $id){

        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/panier');
    }


    public function panier(){

        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);  
    }

    public function retirer_produit($id){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect('/panier');

    }

    public function paiement(){

        if(!Session::has('cart')){
            return view('client.cart');
        }

        return view('client.checkout');
    }


    public function payer(Request $request){

        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_51KBS2IF5KFxKKGq36t3XZIbG6ZwiKyonsMmvWXhT6tNC9bSV80yD9gVOhxw5yNkJykLbwYB8GooCwTZ26hU9dhWB00I4BSC5rNk_test_51KBS2IF5KFxKKGq36t3XZIbG6ZwiKyonsMmvWXhT6tNC9bSV80yD9gVOhxw5yNkJykLbwYB8GooCwTZ26hU9dhWB00I4BSC5rN');

        try{

            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));

          
            $orders = new Order();

            $orders->nom = $request->input('name');
            $orders->adresse = $request->input('adress');
            $orders->panier = serialize($cart);
            $orders->payment_id = $request->id;

            $oders->save();


        } catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect('/paiement');
        }

        Session::forget('cart');
        //Session::put('success', 'Purchase accomplished successfully !');
        return redirect('/panier')->with('status','Votre achat a été effectué avec succès.');
    }

    public function creer_compte(Request $request){
        $this->validate($request, ['email'=>'email|required|unique:clients',
                                    'password'=>'required|min:4']);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status', 'Votre compte a été créé avec succès.');
    }

    public function acceder_compte(Request $request){

        $this->validate($request, ['email'=>'email|required',
                                    'password'=>'required']);

        $client = Client::where('email', $request->input('email'))->first();

        if ($client) {
            # code...

            if (Hash::check($request->input('password'), $client->password)) {
                # code...
                    return redirect('/shop');
            } else {
                # code...
                    return back()->with('status', 'Mot de passe ou email erroné');
            }
            

        } else {
            # code...

            return back()->with('status', 'Vous n'."'".'avez pas de compte');
        }
        
    }

    public function client_login(){

        return view('client.login');
    }

    public function signup(){

        return view('client.signup');
    }

    
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
   public function index()
   {
      $customers = Customer::all()->toArray();
      return array_reverse($customers);
   }
   public function store(Request $request)
   {
     
      $request->validate([
        'name'=> 'required',
        'email'=> 'required',
        'address'=> 'required',
        'phoneNumber'=> 'required'
      ]);

      $customer = new Customer([
         'name' => $request->name,
         'email'=> $request->email,
         'address'=> $request->address,
         'phoneNumber'=> $request->phoneNumber
     ]);

       $customer->save();
      
      return response() ->json('The customer successfully created');
    }
   
   public function edit($id)
   {
    $customers = Customer::find($id);
    return response()->json($customers);
   }
   public function update($id,Request $request)
   {
     $request->validate([
        'name'=> 'required',
        'email'=> 'required',
        'address'=> 'required',
        'phoneNumber'=> 'required'
      ]);
      $customer = Customer::find($id);
      $customer->update($request->all());

      return response()->json('The customer successfully updated.');
   }
   public function destroy($id)
   {
      $customer=Customer::find($id);
      $customer->delete();

      return response()->json('The customer successfully delete.');
   }
}

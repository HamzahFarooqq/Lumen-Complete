<?php 

namespace app\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseBuilder;


class CountryController extends Controller{


    function index()
    {
        echo 'this is home page';
    }



    function list()
    {
        
        try {

            $country = country::all();

            $status = 'success';
            $message = 'all countries name are displayed';
            return ResponseBuilder::result($status, $message, $country);

        }
        catch (\Exception $e) {
            
            $status = 'failed';
            $message = $e->getMessage();
            $country = 0;

            return ResponseBuilder::result($status, $message, $country);
        }

 

    }



    function show($id)
    {
        $country = country::findorfail($id);

        return $country;

    }



    function create(Request $request)
    {

        // print_r($request->all());


        $validate = $this->validate($request,[
            'country' => ['required','string'],
            'city' => ['required','string'],
            'priority' => ['required','numeric'],
        ]);

       

        country::create($validate);

         return redirect()->route('list');
        

        // 2nd method 
  
       
        // $valid = Validator::make($request->all(),[
        //     'country' => ['required','string'],
        //     'city' => ['required','string'],
        //     'priority' => ['required','numeric'],
        // ]);

        // if($valid->fails())
        // {
        //     return response()->json([
        //         'error' => $valid->errors(),
        //     ],401);
        // }

         //     $country = new Country();
    
        //     $country->country = $request->country;
        //     $country->city = $request->city;
        //     $country->priority = $request->priority;
        //     $country->save();



    }



    function edit(Request $request, $id)
    {

        $data = $this->validate($request,[
            'country' => ['required','string'],
            'city' => ['required','string'],
            'priority' => ['required','numeric'],
        ]);

        // dd($data);

        $country = country::find($id);

        $country->update($data);

        // return redirect('country/index');
        return redirect()->route('index');


        

    }


    function delete($id)
    {
        $country = country::findorfail($id);
        $country->delete();

        return redirect()->route('index');
    }


}
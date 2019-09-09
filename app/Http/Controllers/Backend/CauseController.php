<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Cause;
use App\Files;

class CauseController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.cause.';
    }

    public function cause()
    {
    	$causes = Cause::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Cause"'));
	                        $join->on('files.table_id','causes.id');
	                    })
	                    ->join('categories','categories.id','causes.category_id')
	                    ->select('files.*','categories.*','causes.*' )
	                    ->get();
        return view($this->layout.'cause', compact('causes'));
    }

    public function addCause()
    {
        return view($this->layout.'addCause');
    }

    public function causeDonation()
    {
        return view($this->layout.'donation');
    }

    public function insertCause(Request $request)
    {
        $cause = new Cause;

        $cause->title = $request->title;
        $cause->goal = $request->goal;
        $cause->content = $request->content;
        $cause->category_id = $request->category_id;
        $cause->userc_id = auth()->user()->id;

        $cause->save();


    	$name = $this->fileUpload($request);

    	$file = new Files;
    	$file->file_name = $name;
    	$file->table = "Cause";
    	$file->type = "image";
    	$file->table_id = $cause->id;
    	$file->userc_id = auth()->user()->id;
    	$file->save();

    	return $cause;

        // return view($this->layout.'addCause');
    }

    public function causeDetail($id)
    {
    	$cause = Cause::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Cause"'));
	                        $join->on('files.table_id','causes.id');
	                    })
	                    ->join('categories','categories.id','causes.category_id')
	                    ->select('files.*','categories.*','causes.*' )
	                    ->where('causes.id', $id)
	                    ->first();
        return view($this->layout.'causeDetail', compact('cause'));
    }

    public function editCause($id)
    {
    	$cause = Cause::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Cause"'));
	                        $join->on('files.table_id','causes.id');
	                    })
	                    ->join('categories','categories.id','causes.category_id')
	                    ->select('files.*','categories.*','causes.*' )
	                    ->where('causes.id', $id)
	                    ->first();
        return view($this->layout.'editCause', compact('cause'));
    }

    public function deleteCause($id)
    {
    	$cause = Cause::find($id)->delete();
    	if ($cause) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting cause";
    	}
    }

    public function updateCause(Request $request, $id)
    {
        $cause = Cause::find($id);

        $cause->title = $request->title?:$cause->title;
        $cause->goal = $request->goal?:$cause->goal;
        $cause->content = $request->content?:$cause->content;
        $cause->category_id = $request->category_id?:$cause->category_id;

        $cause->update();


		if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);
	    	$file = Files::where('table','Cause')->where('table_id',$cause->id)->first();
	    	$file->file_name = $name;
	    	$file->update();
		}

    	return $cause;
    }

    public function fileUpload(Request $request) {
	    $this->validate($request, [
	        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);

	    if ($request->hasFile('file')) {
	        $image = $request->file('file');
	        $name = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/images');
	        $image->move($destinationPath, $name);
	        // $this->save();

	        return $name;
	    }
	}

	/*Categories*/
	public function fetchCategories(Request $req)
    {
        $data = DB::table('categories')
                ->where('name', 'like', $req->term.'%')
                ->get();

        if (!is_null($req->terms)){
            $data[] = ['id' => $req->terms, 'text' => $req->terms ];
        }

        return response()->json($data);
    }
    

    /*Donation*/
    public function donation(Request $request)
    {
        \Stripe\Stripe::setApiKey ( 'sk_test_jSydx2o1jNo3Je8dPelgZOPM00EM7cSJBQ' );
        try {
            $data = \Stripe\Charge::create ( array (
                    "amount" => $request->amount * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken, // obtained with Stripe.js
                    "description" => "Donation payment." 
            ) );
            return response()->json(['message'=>'Donation Successful'],200);
        } catch ( \Exception $e ) {
            return response()->json(['message'=>'Something went wrong'],500);
        }
    }

}
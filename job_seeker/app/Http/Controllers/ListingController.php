<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
//use App\Http\Controllers\ListingController\Rule;
use Illuminate\Validation\Rule;



class ListingController extends Controller
{
    //show all listing
    public function index(){
        return view('listings.index',[
       // 'heading'=>'Leatest listings',
        'listings'=>Listing::latest()->filter
        (request(['tag',
        'search']))->paginate(6)
    ]);

    }
    //show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing'=> $listing
        ]);
    }
    //create form
    public function create(){
        return view('listings.create');
    }

    //store Listing Data start here
    public function store(Request $request){
      $formFields = $request->validate([
          'title'=>'required',
          'company'=>['required',Rule::unique('listings','company')],
          'location'=>'required',
          'website'=>'required',
           'email'=>['required','email'],
           'tags'=>'required',
           'description'=>'required'
      ]);


     if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $formFields['user_id']= auth()->id();

      Listing::create($formFields);
      return redirect('/')->with('message','Liasting created sucessfully!');
    }

         //store Listing Data start here


    //show edit form
    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);

    }

    //ubtade listings
    public function update(Request $request,Listing $listing)
    {
       //check logged user is owner
       if($listing->user_id !=auth()->id()){
        abort(403,'Unauthorized Action');
       }

        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
             'email'=>['required','email'],
             'tags'=>'required',
             'description'=>'required'
        ]);


       if($request->hasFile('logo')) {
          $formFields['logo'] = $request->file('logo')->store('logos', 'public');
      }

        $listing->update($formFields);
        return back()->with('message','Liasting updaated sucessfully!');
      }

      //delete listing
      public function destroy(Listing $listing){

         //check logged user is owner
       if($listing->user_id !=auth()->id()){
        abort(403,'Unauthorized Action');
       }

        $listing->delete();
        return redirect('/')->with('message','Listing delete sucessfully..');

      }
      // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }


}

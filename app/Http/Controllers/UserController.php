<?php
         
namespace App\Http\Controllers;
use App\Product;         
use App\User;
use Illuminate\Http\Request;
use DataTables;
        
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all(); 
   
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                           

    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('user',compact('users'));
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::updateOrCreate(['id' => $request->user_id],
                ['name' => $request->name, 'detail' => $request->email]);        
   
        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
     
        return response()->json(['success'=>'User deleted successfully.']);
    }
}



// <!-- <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\User;

// class UserController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $users = User::all();
//         // dd($users);
//         return view('test',['user' => $users]);
//         // return response()
//         //     ->json($users);
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         User::create($request->all());
//         return response()
//             ->json(['message' => 'Success: You have added an user']);
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         //
//     }

//     *
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
     
//     public function edit($id)
//     {
//         $user = User::find($id);
//         if (! $user) {
//             return response()
//             ->json(['error' => 'The user is not exists']);
//         }
//         return response()
//             ->json($user);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         $user = User::find($id);
//         if (! $user) {
//             return response()
//             ->json(['error' => 'Error: User not found']);
//         }
//         $user->update($request->all());
//         return response()
//             ->json(['message' => 'Success: You have updated the user']);
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         $user = User::find($id);
//         if (! $user) {
//             return response()
//             ->json(['error' => 'Error: User not found']);
//         }
//         $user->delete();
//         return response()
//             ->json(['message' => 'Success: You have deleted the user']);
//     }
// } -->
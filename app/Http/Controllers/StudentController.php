<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;
use App\Student;
use DataTables;

class StudentController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStudent">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteStudent">Delete</a>';
                           

    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('studentAjax',compact('Students'));
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Student::updateOrCreate(['id' => $request->Student_id],
                ['tenhocsinh' => $request->tenhocsinh, 'sodienthoai' => $request->sodienthoai]);        
   
        return response()->json(['success'=>'Student saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *s
     * @param  \App\Student  $Student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Student = Student::find($id);
        return response()->json($Student);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $Student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
     
        return response()->json(['success'=>'Student deleted successfully.']);
    }
}

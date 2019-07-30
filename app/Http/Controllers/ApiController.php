<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class ApiController extends Controller
{
	public function creat(Request $request)
	{
		$students = new Student();
		$students->Tenhocsinh = $request->input('Tenhocsinh');
		$students->sodienthoai = $request->input('sodienthoai');
		

		$students->save();
		return response()->json($students);
		

	}
    //
}

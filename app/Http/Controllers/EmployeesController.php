<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
//use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employees::with('companies')->latest()->paginate();
        if (request()->ajax()) {
            return view('employee.partials.data-load', compact('data'))->render();
        }
        return view('employee.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create', ['companies' => Companies::latest()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('profile_image');
        if ($file !== null) {

            // SIMPLE UPLOADS FILE
            //$path  = $file->store('uploads', 'public');

            //Resize Image
            $img  = Image::make($request->file('profile_image')->getRealPath())->resize(100, 100)->encode('jpg');
            $hash = md5($img->__toString().time());
            $filename = "{$hash}.jpg";
            $path = "public/uploads/" . $filename;
            $store_path = "uploads/" . $filename;
            Storage::put($path, $img->__toString());

            $data['profile_image'] = $store_path;
        }


        Employees::create($data);
        //return redirect()->route('employee.index');
        return response()->json([
            'status' => 'succcess',
            'message' => 'Employee Created Successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employee)
    {
        return view('employee.edit', ['employee' => $employee, 'companies' => Companies::latest()->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, int $id)
    {
        $data = $request->validated();

        $file = $request->file('profile_image');
        if ($file !== null) {

            //$path  = $file->store('uploads', 'public');
            $img  = Image::make($request->file('profile_image')->getRealPath())->resize(100, 100)->encode('jpg');
            $hash = md5($img->__toString().time());
            $filename = "{$hash}.jpg";
            $path = "public/uploads/" . $filename;
            $store_path = "uploads/" . $filename;
            Storage::put($path, $img->__toString());

            $data['profile_image'] = $store_path;
        }
        $employee = Employees::findOrFail($id);
        $employee->update($data);

        $imageName = $data['profile_image']??'';
        return response()->json([
            'image'=>$imageName,
            'status' => 'succcess',
            'message' => 'Employee Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();
        return response()->json([
            'status' => 'succcess',
            'message' => 'Employee deleted successfully!'
        ]);
    }
}

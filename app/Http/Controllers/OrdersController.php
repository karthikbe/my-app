<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Orders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function index(Request $request)
    {

        Log::info("<----- Welcome My APP ---->");
        Log::debug("<----- Index Method Called ---->");
        Log::debug('This is a debug message.');
        Log::info('An informational message.');
        Log::warning('Something potentially wrong.');
        Log::error('An error occurred!');

        if($request->ajax())
        {
            $data = Orders::select("*");

            if($request->filled('from_date') && $request->filled('to_date'))
            {
                $data = $data->whereBetween('order_date', [$request->from_date, $request->to_date]);
            }

           

            return DataTables::of($data)
                ->addColumn('p_name', function ($data) {
                    $route = route('orders.edit', $data->id); 
                    return "<a href='$route'>$data->p_name</a>";
                })
                ->addColumn('link', function ($data) {
                    $route = route('orders.delete',$data->id); 


                   $dsn = "<button onclick='destoryOrder($data->id)'  id='$data->id' class='btn btn-danger btn-xs py-0 delete-order-btn'>
                    Delete</button>";

                //    return $dsn;

                    return "<a stytle='' class='btn btn-primary btn-sm' href='$route'>Delete</a>";
                })
                ->rawColumns(['link','p_name'])
                
                ->addIndexColumn()->make(true);
        }

        // $user = Orders::all();
        return view("orders");
    }

    public function edit(Orders $orders)
    {   
        // $employee = Employee::find($id);
        return view('edit',compact('orders'));
    }

    public function create(Orders $orders)
    {   
        // $employee = Employee::find($id);
        return view('create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'p_name' => 'required',
            'email' => 'required|unique:orders,email|email',
            'order_count' => 'required',
        ]);

       $data = $request->except('_token');
       //dd($data);
        // Mass assigment
        //Orders::create($data);

        $orders = new Orders();
        $orders->p_name = $data['p_name'];
        $orders->email = $data['email'];
        $orders->order_count = $data['order_count'];
        $orders->order_date = now();
        $orders->save();

        return redirect()
        ->route('orders.index')
        ->withSuccess('Order has been created successfully!');
        
    }

    public function update(Request $request, Orders $orders)
    {
       
        // $request->validate([
        //     'p_name' => 'required',
        //     'email' => 'required|unique:orders,email|email',
        //     'order_count' => 'required',
        // ]);

        $data = $request->except('_token');
        $orders->update($data); 
        //dd($data);
       
       
        // $orders->update($data);

        return redirect()
        ->route('orders.index')
        ->withSuccess('Order has been created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Orders $orders)
    {
        
        // dd($orders);
       
        $orders->delete();
        return redirect()->route('orders.index')
        ->withSuccess('Order deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function importOrder(Request $request)
    {

        return view('import');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function uploadOrder(Request $request)
    {

        Excel::import(new UsersImport, $request->file);
        
        return redirect()->route('orders.index')->with('success', 'User Imported Successfully');
       
    }

    
    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:employees,email|email',
    //         'joining_date' => 'required',
    //         'phone' => 'required|numeric|unique:employees,phone',
    //         'salary' => 'required',
    //     ],[
    //        'phone.unique' => 'Phone number already exist' 
    //     ]);

    //    $data = $request->except('_token');
    //     // Mass assigment
    //     Employee::create($data);
   
    //     // Insert Single row
    //     //    $employee = new Employee;
    //     //    $employee->name = $data['name'];
    //     //    $employee->email = $data['email'];
    //     //    $employee->joining_date = $data['joining_date'];
    //     //    $employee->salary = $data['salary'];
    //     //    $employee->phone = $data['phone'];
    //     //    $employee->is_active = $data['is_active'];
    //     //    $employee->save();
    //     return redirect()
    //     ->route('employee.index')
    //     ->withSuccess('Employee has been created successfully!');
        
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Employee $employee)
    // {
    //    return view('show',compact('employee'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Employee $employee)
    // {   
    //     // $employee = Employee::find($id);
    //     return view('edit',compact('employee'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Employee $employee)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:employees,email,'.$employee->id.'|email',
    //         'joining_date' => 'required',
    //         'phone' => 'required|numeric|unique:employees,phone,'.$employee->id,
    //         'salary' => 'required',
    //     ],[
    //        'phone.unique' => 'Phone number already exist' 
    //     ]);
        
    //     $data = $request->all();

    //     // $employee = Employee::find($id);
    //     $employee->update($data);
    //     return redirect()->route('employee.edit',$employee->id)
    //     ->withSuccess('Employee details updated successfully!');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Employee $employee)
    // {
    //     $employee->delete();
    //     return redirect()->route('employee.index')
    //     ->withSuccess('Employee deleted successfully');
    // }
}

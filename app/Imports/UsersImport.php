<?php

namespace App\Imports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       //dd($row);
        
        $order =  new Orders([
            "p_name"     => $row['p_name'],
            "order_count"    => $row['order_count'],
            "email" => $row['email'],
            "order_date" => now(),
        ]);

       // $order->assignRole($order->id);

        return $order;
    }
}

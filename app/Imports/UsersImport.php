<?php

namespace App\Imports;

use App\Models\Orders;
use DateTime;
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
            "WO"     => $row['wo'],
            "District"    => $row['district'],
            "LeadTech" => $row['leadtech'],
            "Service" => $row['service'],
            "Rush" => $row['rush'],
            "ReqDate" => \DateTime::createFromFormat("d/m/y H:i", $row['reqdate'])->format("Y-m-d H:i:s"),
            "WorkDate" => \DateTime::createFromFormat("d/m/y H:i", $row['workdate'])->format("Y-m-d H:i:s"),
            "Techs" => $row['techs'],
            "WtyLbr" => $row['wtylbr'],
            "WtyParts" => $row['wtyparts'],
            "LbrHrs" => $row['lbrhrs'],
            "PartsCost" => $row['partscost'],
            "Payment" => $row['payment'],
            "Wait" => $row['wait'],
            "LbrRate" => $row['lbrrate'],
            "LbrCost" => $row['lbrcost'],
            "LbrFee" => $row['lbrfee'],
            "PartsFee" => $row['partsfee'],
            "TotalCost" => $row['totalcost'],
            "TotalFee" => $row['totalfee'],
            "ReqDay" => $row['reqday'],
            "WorkDay" => $row['workday'],

            "order_date" => now(),
        ]);

       // $order->assignRole($order->id);

        return $order;
    }
}

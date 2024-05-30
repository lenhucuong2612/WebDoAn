<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $data['header_title']="Dashboard";
        $data['TotalOrder']=OrderModel::getTotalOrder();
        $data['TotalTodayOrder']=OrderModel::getTotalTodayOrder();
        $data['TotalAmount']=OrderModel::getTotalAmount();
        $data['TotalTodayAmount']=OrderModel::getTotalTodayAmount();
        $data['TotalCustomer']=User::getTotalUser();
        $data['TotalTodayCustomer']=User::getTotalTodaylUser();

        $data['getLastestOrder']=OrderModel::getLastestOrders();
        if(!empty($request->year))
        {
            $year=$request->year;
        }else{
            $year=date('Y');
        }
        $getTotalCustomerMonth='';
        $getTotalOrderMonth='';
        $getTotalOrderAmountMonth='';
        $totalAmount=0;
        for($month=1; $month<=12;$month++)
        {
            $startDate=new \DateTime("$year-$month-01");
            $endDate=new \DateTime("$year-$month-01");
            $endDate->modify('last day of this month');
            $start_date=$startDate->format('Y-m-d');
            $end_date=$endDate->format('Y-m-d');

            $customer=User::getTotalCustomerMonth($start_date,$end_date);
            $getTotalCustomerMonth .=$customer.',';

            $order=OrderModel::getTotalOrderMonth($start_date,$end_date);
            $getTotalOrderMonth .=$order.',';

            $orderPayment=OrderModel::getTotalOrderAmountMonth($start_date,$end_date);
            $getTotalOrderAmountMonth .=$orderPayment.',';

            $totalAmount=$totalAmount+$orderPayment;

        }
        $data['getTotalCustomerMonth']=rtrim($getTotalCustomerMonth,',');
        $data['getTotalOrderMonth']=rtrim($getTotalOrderMonth,',');
        $data['getTotalOrderAmountMonth']=rtrim($getTotalOrderAmountMonth,',');
        $data['total_amount']=$totalAmount;
        $data['year']=$year;
        return view("admin.dashboard",$data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Report;
use App\Models\ReportDetail;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportDetail::query()->delete();
        Report::query()->delete();

        $period = \Carbon\CarbonPeriod::create('2022-01-01', date('Y-m-d'));

        $minIncome = '65000';
        $maxIncome = '200000';

        $products = Product::all();

        foreach($period as $row) {
            $name = $row->format('d-m-Y');
            $dateStr = $row->format('Y-m-d');
            $firstPrefixIncomeRange = (string)mt_rand(150, 1500);
            $report = Report::create([
                'name' => 'laporan ('.$name.')',
                // 'total_income' => $firstPrefixIncomeRange.'00',
                'tanggal' => $dateStr
            ]);

            echo 'Report '.$report->name.'<br />';

            $totalProduct = \mt_rand(3,15);
            $detailProduct = $products->shuffle()->take($totalProduct);
            foreach($detailProduct as $rowProduct) {
                $quantity = \mt_rand(2, 8);
                $subTotal = $rowProduct->price * $quantity;
                $report->details()->create([
                    'sub_total' => $subTotal,
                    'quantity' => $quantity,
                    'product_id' => $rowProduct->id
                ]);
            }

            $report->total_income = $report->total_income;
            $report->save();

            echo 'Total Item '.$report->details->sum('quantity').'<br />';
            echo 'Total Income '.$report->total_income.'<br /><br />';
        }
    }
}

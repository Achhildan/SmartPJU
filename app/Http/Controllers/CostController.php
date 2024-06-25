<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PowerModel;
use App\Models\PowerModif;
use Illuminate\Support\Facades\DB;

class CostController extends Controller
{
    public function index(Request $request)
    {
        return $this->renderView('cost', $request);
    }

    private function renderView($viewName, Request $request = null)
    {
        $field_name = "name";
        $selected_name = $request ? $request->input($field_name, null) : null;

        $modif_table = $selected_name ? PowerModif::getTableName($selected_name) : null;

        $monthly_data = $selected_name ? $this->calculateMonthlyPower($modif_table) : [];
        $total_monthly_data = !$selected_name ? $this->calculateTotalMonthlyPower() : [];
        $latestData = $selected_name ? $this->getLatestData($modif_table) : null;

        $names = PowerModel::distinct()->pluck($field_name);

        return view($viewName, compact('names', 'field_name', 'selected_name', 'monthly_data', 'total_monthly_data', 'latestData'));
    }

    private function calculateMonthlyPower($table)
    {
        $cost_per_watt = 0.001; // Tentukan biaya per watt
        $results = DB::table($table)
            ->select(DB::raw('YEAR(time) as year, MONTH(time) as month, SUM(power) as total_power'))
            ->groupBy(DB::raw('YEAR(time), MONTH(time)'))
            ->orderByDesc(DB::raw('YEAR(time), MONTH(time)'))
            ->get();

        $monthly_data = [];
        foreach ($results as $result) {
            $month_name = date("F", mktime(0, 0, 0, $result->month, 10));
            $total_cost = $result->total_power * $cost_per_watt; // Menghitung biaya total
            $monthly_data[] = [
                'year' => $result->year,
                'month' => $month_name,
                'total_power' => $result->total_power,
                'total_cost' => $total_cost // Menambahkan biaya total ke data bulanan
            ];
        }

        return $monthly_data;
    }

    private function calculateTotalMonthlyPower()
    {
        $cost_per_watt = 0.001; // Tentukan biaya per watt

        $names = PowerModel::distinct()->pluck('name');
        $total_monthly_data = [];

        foreach ($names as $name) {
            $table = PowerModif::getTableName($name);
            $results = DB::table($table)
                ->select(DB::raw('YEAR(time) as year, MONTH(time) as month, SUM(power) as total_power'))
                ->groupBy(DB::raw('YEAR(time), MONTH(time)'))
                ->orderByDesc(DB::raw('YEAR(time), MONTH(time)'))
                ->get();

            foreach ($results as $result) {
                $month_key = "{$result->year}-{$result->month}";
                $total_cost = $result->total_power * $cost_per_watt;

                if (isset($total_monthly_data[$month_key])) {
                    $total_monthly_data[$month_key]['total_power'] += $result->total_power;
                    $total_monthly_data[$month_key]['total_cost'] += $total_cost;
                } else {
                    $month_name = date("F", mktime(0, 0, 0, $result->month, 10));
                    $total_monthly_data[$month_key] = [
                        'year' => $result->year,
                        'month' => $month_name,
                        'total_power' => $result->total_power,
                        'total_cost' => $total_cost,
                    ];
                }
            }
        }

        return array_values($total_monthly_data);
    }

    private function getLatestData($table)
    {
        $cost_per_watt = 0.001; // Tentukan biaya per watt

        $latestRecord = DB::table($table)
            ->orderBy('time', 'desc')
            ->first(['power']);

        if ($latestRecord) {
            $latestPower = $latestRecord->power;
            $latestCost = $latestPower * $cost_per_watt;
        } else {
            $latestPower = 0;
            $latestCost = 0;
        }

        return [
            'latestPower' => $latestPower,
            'latestCost' => $latestCost
        ];
    }
}

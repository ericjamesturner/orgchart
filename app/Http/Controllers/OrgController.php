<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    protected $sortableColumns = [
        'name', 'boss', 'depth',
    ];

    protected $sortOrders = [
        'asc', 'desc'
    ];

    protected $defaultOrdering = [
        'orderBy' => 'depth',
        'order' => 'asc',
    ];

    public function chart(Request $request)
    {
        $query = DB::table('employees')
            ->join('employees_closure', 'employees.id', 'employees_closure.employee_id')
            ->join('employees as e', 'employees.bossId', 'e.id')
            ->select('employees.*', 'employees_closure.depth', 'e.name as boss');

        $append = $this->handleOrdering($request, $query);

        $chart = $query->paginate(100)->appends($append);

        return view('chart', [
            'chart' => $chart,
            'ordered' => $append,
        ]);
    }

    protected function handleOrdering($request, $query)
    {
        if ($request->has('orderBy') || $request->has('order')) {

            $sort = [
                'orderBy' => $this->filterInput($request->input('orderBy'), $this->sortableColumns),
                'order' => $this->filterInput($request->input('order'), $this->sortOrders),
            ];

            $query->orderBy(...array_values(
                array_merge($this->defaultOrdering, array_filter($sort))
            ));

            return array_filter($sort);
        }

        return [];
    }

    protected function filterInput($needle, $array)
    {
        $needle = strtolower($needle);

        return in_array($needle, $array) ? $needle : null;
    }
}

<?php

namespace App\Jobs;

use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class FillClosureTable
{
    use Dispatchable, Queueable;

    protected $employeesClosureTable = 'employees_closure';

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->truncateClosureTable();

        $this->importData();
    }

    /**
     * Spin through the employees and import them into the closure table.
     *
     * @return void
     */
    public function importData()
    {
        $cache = [];

        $employees = DB::table('employees')
            ->orderBy('bossId')
            ->orderBy('id')
            ->chunk(1000, function ($employees) use (&$cache) {
                $records = [];

                foreach ($employees as $employee) {
                    $depth = isset($cache[$employee->bossId]) ?
                        $cache[$employee->bossId] + 1 :
                        0;

                    $cache[$employee->id] = $depth;

                    $records[] = [
                        'employee_id' => $employee->id,
                        'parent_id' => $employee->bossId,
                        'depth' => $depth
                    ];
                }

                $this->insertChunk($records);
            });
    }

    /**
     * Insert the data from the chunk.
     *
     * @param array $data
     * @return bool
     */
    public function insertChunk($data)
    {
        return DB::table($this->employeesClosureTable)
            ->insert($data);
    }

    /**
     * Truncate the closure table.
     *
     * @return void
     */
    public function truncateClosureTable()
    {
        DB::table($this->employeesClosureTable)
            ->truncate();
    }
}

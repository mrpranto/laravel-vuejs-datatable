<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    protected $hideColumn;

    public function __construct($hideColumn)
    {
        $this->hideColumn = $hideColumn;
    }

    public function view(): View
    {
        return view('export.excel_csv', [
            'hide_columns' => $this->hideColumn,
            'students' => Student::with('classInfo')->get()
        ]);
    }
}

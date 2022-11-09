<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class StudentController extends Controller
{
    public function students()
    {
        $paginate = request('paginate', 10);
        $search = request('search');
        $order_by = request('order_by', 'id');
        $order_dir = request('order_dir', 'desc');

        $students = Student::query()
            ->with('classInfo')
            ->when($search, function (Builder $builder) use ($search){
                $builder->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('age', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhereHas('classInfo', function (Builder $builder) use ($search){
                        $builder->where('class_name', 'like', "%$search%");
                    });
            })
            ->when($order_by && $order_dir, function (Builder $builder) use ($order_by, $order_dir){
                if ($order_by == 'class_info'){
                    $builder->with(['classInfo' => function($q) use($order_dir){
                        $q->orderBy('class_name', $order_dir);
                    }]);
                }else{
                    $builder->orderBy($order_by, $order_dir);
                }
            })
            ->paginate($paginate);

        return new \App\Http\Resources\Student($students);
    }

    public function downloadPDF()
    {
        $students = Student::with('classInfo')->get();

        $pdf = PDF::loadView('export.pdf', compact('students'));

        $fileName = 'Student-List.pdf';

        return $pdf->download($fileName);
    }

    public function downloadExcel()
    {
        return Excel::download(new StudentExport, 'Students.xlsx');
    }

    public function downloadCSV()
    {
        return Excel::download(new StudentExport, 'Students.csv');
    }
}

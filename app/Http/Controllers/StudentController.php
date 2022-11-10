<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\ClassInfo;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class StudentController extends Controller
{
    public function classInfos()
    {
        return ClassInfo::query()->get(['id', 'class_name']);
    }

    public function students()
    {
        $paginate = request('paginate', 10);
        $search = request('search');
        $order_by = request('order_by', 'id');
        $order_dir = request('order_dir', 'desc');

        $students = Student::query()
            ->with('classInfo')
            ->when(request('id'), function (Builder $builder){
                $builder->where('id', 'like', "%".request('id')."%");
            })
            ->when(request('classInfo'), function (Builder $builder){
                $builder->whereHas('classInfo', function (Builder $builder){
                    $builder->where('id', request('classInfo'));
                });
            })
            ->when(request('name'), function (Builder $builder){
                $builder->where('name', 'like', "%".request('name')."%");
            })
            ->when(request('phone'), function (Builder $builder){
                $builder->where('phone', 'like', "%".request('phone')."%");
            })
            ->when(request('email'), function (Builder $builder){
                $builder->where('email', 'like', "%".request('email')."%");
            })
            ->when(request('age'), function (Builder $builder){
                $builder->where('age', 'like', "%".request('age')."%");
            })
            ->when(request('address'), function (Builder $builder){
                $builder->where('address', 'like', "%".request('address')."%");
            })
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
        $hide_columns = explode(',', request('hide_col'));

        $pdf = PDF::loadView('export.pdf', compact('students', 'hide_columns'));

        $fileName = 'Student-List.pdf';

        return $pdf->download($fileName);
    }

    public function downloadExcel()
    {
        $hide_columns = explode(',', request('hide_col'));

        return Excel::download(new StudentExport($hide_columns), 'Students.xlsx');
    }

    public function downloadCSV()
    {
        $hide_columns = explode(',', request('hide_col'));

        return Excel::download(new StudentExport($hide_columns), 'Students.csv');
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\ExpensesBudgetDataTable;
use App\DataTables\ExpensesDataTable;

class ReportController extends Controller
{
    public function index(ExpensesBudgetDataTable $dataTable)
    {
        return $dataTable->render('report');
    }
}

<?php

namespace App\DataTables;

use App\Models\ExpensesBudget;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpensesBudgetDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_at', function (ExpensesBudget $expensesBudget) {
                return $expensesBudget->created_at->format('d-m-Y') . ' - ' . $expensesBudget->day_name;
            })
            ->addColumn('savings', function (ExpensesBudget $expensesBudget) {
                $diff = $expensesBudget->actual_budget - $expensesBudget->expense;
                if ($diff < 0) {
                    return '<span class="ms-3 badge text-bg-warning fs-6"> '.$diff.'</span>';
                }else{
                    return '<span class="ms-3 badge text-bg-success fs-6"> + '.$diff.'</span>';
                }
            })
            ->rawColumns(['savings']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ExpensesBudget $model): QueryBuilder
    {
        return $model->newQuery()->where('user_id', auth()->id());
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('expensesbudget-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('csv'),
                Button::make('print'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('created_at')->orderable(true)->title('Date Of Purchase'),
            Column::make('expense')->orderable(true)->title('Amount spent'),
            Column::make('actual_budget')->orderable(true)->title('Budget Allotted'),
            Column::make('savings')->title('Amount Saved')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ExpensesBudget_' . date('YmdHis');
    }
}

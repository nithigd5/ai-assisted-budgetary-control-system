<?php

namespace App\DataTables;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpensesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('product_name', function (Expense $expense) {
                return $expense->product->name;
            })
            ->addColumn('created_at', function (Expense $expense) {
                return $expense->created_at->format('d-m-Y');
            })
            ->addColumn('mode', function (Expense $expense) {
                return '<span class="badge text-bg-warning">' . $expense->mode . ' </span>';
            })
            ->rawColumns(['mode']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Expense $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('user_id', auth()->id())
            ->latest()
            ->with('product')
            ->whereHas('product', function ($query) {
                $query->where('name', 'like', '%' . request('search.value') . '%');
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('expenses-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(3)
            ->selectStyleSingle()
            ->lengthMenu([10, 25, 50, 100])
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
            Column::make('product_name')->title('Product')->data('product.name')->searchable(true)->orderable(true),
            Column::make('price')->title('Price'),
            Column::make('mode')->title('Payment Mode'),
            Column::make('created_at')->title('Purchased At')->orderable(true)->orderable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Expenses_' . date('YmdHis');
    }
}

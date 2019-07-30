<?php

namespace App\DataTables;

use App\Model\Shipping;
use Yajra\DataTables\Services\DataTable;

class ShippingDatatable extends DataTable
{
    /**
     * Build DataTable class.

     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.shipping.btn.checkbox')
            ->addColumn('edit', 'admin.shipping.btn.edit')
            ->addColumn('delete', 'admin.shipping.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
               
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Shipping::query()->with('user_id')->select('shippings.*');
    }
   

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                   // ->addAction(['width' => '80px'])
                   // ->parameters($this->getBuilderParameters());
                    ->parameters([

                        'dom'=>'Blfrtip',
                        'lengthMenu'=>[[10,25,50,100], [10, 25, 50, trans('admin.all_record')]],
                        'buttons'=>[

                                ['className'=>'btn btn-info', 'text'=>'<i class="fa fa-plus"></i>'.' '.trans('admin.add'), 'action'=>"function(){
                                    window.location.href = '". \URL::current() ."/create';
                                }"],
                                ['extend'=>'print', 'className'=>'btn btn-primary', 'text'=>'<i class="fa fa-print"></i>'.' '.trans('admin.print')],
                                ['extend'=>'csv', 'className'=>'btn btn-info', 'text'=>'<i class="fa fa-file"></i>'.' '.trans('admin.csv')],
                                ['extend'=>'excel', 'className'=>'btn btn-success', 'text'=>'<i class="fa fa-file"></i>'.' '.trans('admin.excel')],
                                ['extend'=>'reload', 'className'=>'btn btn-default', 'text'=>'<i class="fa fa-refresh"></i>'.' '.trans('admin.refresh')],
                                ['className'=>'btn btn-danger delBtn', 'text'=>'<i class="fa fa-trash"></i>'.' '.trans('admin.delete_all')],
                        ],
                        'initComplete'=>'function () {
                                            this.api().columns([2,3]).every(function () {
                                                var column = this;
                                                var input = document.createElement("input");
                                                $(input).appendTo($(column.footer()).empty())
                                                .on("keyup", function () {
                                                    column.search($(this).val(), false, false, true).draw();
                                                });
                                            });
                                        }',

                        'language'=>  datatable_lang(),

                      
                  

                    ]);
    } 

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        

        return [
          [
            'name'          =>'checkbox',
            'data'          =>'checkbox',
            'title'         =>'<input type="checkbox" class="check_all" onclick="check_all()" />',
            'exportable'    =>false,
            'printable'     =>false,
            'orderable'     =>false,
            'searchable'    =>false,

          ],[
            'name'  =>'id',
            'data'  =>'id',
            'title' =>'#',
          ],[
            'name'  =>'name_ar',
            'data'  =>'name_ar',
            'title' =>trans('admin.shipping_name_ar'),
          ],[
            'name'  =>'name_en',
            'data'  =>'name_en',
            'title' =>trans('admin.shipping_name_en'),
          ],[
            'name'  =>'user_id.name',
            'data'  =>'user_id.name',
            'title' =>trans('admin.owner_id'),
          ],[
            'name'  =>'created_at',
            'data'  =>'created_at',
            'title' =>trans('admin.created_at'),
          ],[
            'name'  =>'updated_at',
            'data'  =>'updated_at',
            'title' =>trans('admin.updated_at'),
          ],[
            'name'          =>'edit',
            'data'          =>'edit',
            'title'         =>trans('admin.edit'),
            'exportable'    =>false,
            'printable'     =>false,
            'orderable'     =>false,
            'searchable'    =>false,
          ],[
            'name'          =>'delete',
            'data'          =>'delete',
            'title'         =>trans('admin.delete'),
            'exportable'    =>false,
            'printable'     =>false,
            'orderable'     =>false,
            'searchable'    =>false,
          ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'shipping_' . date('YmdHis');
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Models\Statistic;

class SalesExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */

    protected $timer_type;
    protected $timer_from;
    protected $timer_to;

    function __construct($timer_type = null, $timer_from = null, $timer_to = null) {
        $this->timer_type = $timer_type;
        $this->timer_from = $timer_from;
        $this->timer_to = $timer_to;
    }

    public function collection()
    {
        if($this->timer_type == 'daily_report'){
            $today = Carbon::today()->format('d/m/Y');

            $data = Statistic::where('order_date', $today)->orderBy('order_date', 'ASC')->get();

            return collect($data);
        }else{
            $data = Statistic::whereBetween('order_date', [$this->timer_from, $this->timer_to])->orderBy('order_date', 'ASC')->get();

            return collect($data);
        }
    }

    public function headings(): array
    {
        return [
                'No',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
        ];
    }


}

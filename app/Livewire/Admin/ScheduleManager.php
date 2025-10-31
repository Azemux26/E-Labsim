<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LabSchedule;
use App\Models\LabSimulator;
use App\Exports\LabSchedulesExport;

class ScheduleManager extends Component
{
    use WithPagination;

    public $search = '';
    public $filterLab = '';
    public $filterTahun = '';

    public function render()
    {
        $query = LabSchedule::with(['labSimulator', 'pengajar', 'kalab'])
            ->orderBy('tanggal', 'desc');

        if ($this->search) {
            $query->whereHas('pengajar', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterLab) {
            $query->where('lab_simulator_id', $this->filterLab);
        }

        if ($this->filterTahun) {
            $query->whereYear('tanggal', $this->filterTahun);
        }

        $schedules = $query->paginate(10);
        $labs = LabSimulator::all();

        return view('livewire.admin.schedule-manager', [
            'schedules' => $schedules,
            'labs' => $labs,
        ]);

    }

    public function exportPdf()
{
    $export = new LabSchedulesExport($this->filterLab, $this->filterTahun);
    return $export->toPdf();
}

public function exportExcel()
{
    return Excel::download(
        new LabSchedulesExport($this->filterLab, $this->filterTahun),
        'lab_schedules.xlsx'
    );
}
}

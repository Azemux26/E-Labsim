<?php

namespace App\Exports;

use App\Models\LabSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LabSchedulesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $filterLab;
    protected $filterTahun;

    public function __construct($filterLab = null, $filterTahun = null)
    {
        $this->filterLab = $filterLab;
        $this->filterTahun = $filterTahun;
    }

    public function collection()
    {
        $query = LabSchedule::with(['labSimulator', 'pengajar', 'kalab'])
            ->orderBy('tanggal', 'desc');

        if ($this->filterLab) {
            $query->where('lab_simulator_id', $this->filterLab);
        }

        if ($this->filterTahun) {
            $query->whereYear('tanggal', $this->filterTahun);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lab / Simulator',
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Jenis Kegiatan',
            'Detail Materi',
            'Jumlah Peserta',
            'Status Verifikasi',
            'Pengajar',
            'Kepala Lab',
        ];
    }

    public function map($schedule): array
    {
        static $no = 1;

        return [
            $no++,
            $schedule->labSimulator->name ?? '-',
            $schedule->tanggal->format('d/m/Y'),
            $schedule->jam_mulai,
            $schedule->jam_selesai,
            $schedule->jenis_kegiatan,
            $schedule->detail_materi,
            $schedule->jumlah_peserta,
            $schedule->status_verifikasi,
            $schedule->pengajar->name ?? '-',
            $schedule->kalab->name ?? '-',
        ];
    }

    /**
     * Export PDF langsung dari data yang sama
     */
    public function toPdf()
    {
         $data = $this->collection();

    $pdf = Pdf::loadView('exports.lab-schedules-pdf', [
        'schedules' => $data,
    ])->setPaper('a4', 'landscape');

    return response()->streamDownload(
        fn() => print($pdf->output()),
        'lab_schedules.pdf'
    );
    }
}

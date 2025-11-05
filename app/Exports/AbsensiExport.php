<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    protected $tanggalAwal;
    protected $tanggalAkhir;
    protected $keyword;

    public function __construct($tanggalAwal, $tanggalAkhir, $keyword = null)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
        $this->keyword = $keyword;
    }

    public function collection()
    {
        $query = \App\Models\Absensi::with('mahasiswa')->orderBy('tanggal', 'asc');

        if ($this->tanggalAwal && $this->tanggalAkhir) {
            $query->whereBetween('tanggal', [$this->tanggalAwal, $this->tanggalAkhir]);
        }

        if ($this->keyword) {
            $query->whereHas('mahasiswa', function ($q) {
                $q->where('nama', 'like', "%{$this->keyword}%")
                  ->orWhere('nim', 'like', "%{$this->keyword}%");
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['Nama', 'NIM', 'Tanggal', 'Jam Masuk', 'Jam Keluar'];
    }

    // Format per baris data yang dikembalikan ke Excel
    public function map($item): array
    {
        return [
            $item->mahasiswa->nama,
            "'" . $item->mahasiswa->nim, // tanda kutip agar dianggap teks
            $item->tanggal,
            $item->jam ?? '-',
            $item->jam_keluar ?? '-',
        ];
    }

    // Format kolom secara eksplisit
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT, // Kolom NIM = teks
        ];
    }
}

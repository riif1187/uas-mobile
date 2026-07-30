<?php

namespace App\Observers;

use App\Models\CapaianPrestasi;
use App\Models\FuzzyKlasifikasi;
use App\Services\FuzzyPrestasiService;

class CapaianPrestasiObserver
{
    public function created(CapaianPrestasi $capaian): void
    {
        $this->refreshFuzzy($capaian);
    }

    public function updated(CapaianPrestasi $capaian): void
    {
        $this->refreshFuzzy($capaian);
    }

    public function deleted(CapaianPrestasi $capaian): void
    {
        $this->refreshFuzzy($capaian);
    }

    private function refreshFuzzy(CapaianPrestasi $capaian): void
    {
        $capaian->load('pendaftaranPrestasi');
        $nim = $capaian->pendaftaranPrestasi?->NIM;
        if (!$nim) return;

        $service = app(FuzzyPrestasiService::class);
        $result = $service->classify($nim);

        if (!$result) return;

        FuzzyKlasifikasi::updateOrCreate(
            ['NIM' => $nim],
            [
                'jumlah_prestasi'   => $result['jumlah_prestasi'],
                'total_poin'        => $result['total_poin'],
                'peringkat_terbaik' => $result['peringkat_terbaik'],
                'skor_fuzzy'        => $result['skor'],
                'label_fuzzy'       => $result['label'],
            ]
        );
    }
}

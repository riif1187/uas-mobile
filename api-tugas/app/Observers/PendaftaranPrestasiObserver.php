<?php

namespace App\Observers;

use App\Models\PendaftaranPrestasi;
use App\Models\FuzzyKlasifikasi;
use App\Services\FuzzyPrestasiService;

class PendaftaranPrestasiObserver
{
    public function created(PendaftaranPrestasi $pendaftaran): void
    {
        $this->refreshFuzzy($pendaftaran->NIM);
    }

    public function updated(PendaftaranPrestasi $pendaftaran): void
    {
        $this->refreshFuzzy($pendaftaran->NIM);
    }

    public function deleted(PendaftaranPrestasi $pendaftaran): void
    {
        $this->refreshFuzzy($pendaftaran->NIM);
    }

    private function refreshFuzzy(?string $nim): void
    {
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

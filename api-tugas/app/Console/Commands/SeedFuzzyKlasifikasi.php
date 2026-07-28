<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('seed:fuzzy-klasifikasi')]
#[Description('Jalankan klasifikasi fuzzy dan simpan ke tabel fuzzy_klasifikasi')]
class SeedFuzzyKlasifikasi extends Command
{
    public function handle()
    {
        $service = new \App\Services\FuzzyPrestasiService();
        $results = $service->classifyAll();

        foreach ($results as $r) {
            \App\Models\FuzzyKlasifikasi::updateOrCreate(
                ['NIM' => $r['NIM']],
                [
                    'jumlah_prestasi'   => $r['jumlah_prestasi'],
                    'total_poin'        => $r['total_poin'],
                    'peringkat_terbaik' => is_numeric($r['peringkat_terbaik']) ? (int)$r['peringkat_terbaik'] : 0,
                    'skor_fuzzy'        => $r['skor'],
                    'label_fuzzy'       => $r['label'],
                ]
            );
        }

        $this->info(count($results) . ' data klasifikasi berhasil disimpan!');
    }
}

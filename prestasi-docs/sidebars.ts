import type {SidebarsConfig} from '@docusaurus/plugin-content-docs';

const sidebars: SidebarsConfig = {
  flutter: [
    {
      type: 'category',
      label: 'Aplikasi Flutter',
      collapsible: false,
      items: [
        'flutter/overview',
        'flutter/arsitektur',
        'flutter/struktur-kode',
        'flutter/routing',
        'flutter/halaman',
        'flutter/flowchart',
      ],
    },
  ],
  laravel: [
    {
      type: 'category',
      label: 'Web Laravel',
      collapsible: false,
      items: [
        'laravel/overview',
        'laravel/arsitektur',
        'laravel/landing-page',
        'laravel/modul',
        'laravel/autentikasi',
        'laravel/flowchart',
      ],
    },
  ],
  database: [
    {
      type: 'category',
      label: 'Database',
      collapsible: false,
      items: ['database/erd', 'database/relasi'],
    },
  ],
  flowchart: [
    {
      type: 'category',
      label: 'Flowchart Sistem',
      collapsible: false,
      items: [
        'flowchart/sistem',
        'flowchart/alur-prestasi',
        'flowchart/fuzzy',
        'flowchart/autentikasi-api',
      ],
    },
  ],
  api: [
    {
      type: 'category',
      label: 'API Reference',
      collapsible: false,
      items: ['api/reference'],
    },
  ],
  deployment: [
    {
      type: 'category',
      label: 'Deployment',
      collapsible: false,
      items: ['deployment/arsitektur', 'deployment/script'],
    },
  ],
  panduan: [
    {
      type: 'category',
      label: 'Panduan',
      collapsible: false,
      items: ['panduan/menjalankan', 'panduan/akun'],
    },
  ],
};

export default sidebars;

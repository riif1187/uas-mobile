import {themes as prismThemes} from 'prism-react-renderer';
import type {Config} from '@docusaurus/types';
import type * as Preset from '@docusaurus/preset-classic';

const config: Config = {
  title: 'Prestasi Mahasiswa Docs',
  tagline: 'Dokumentasi Sistem Pencatatan Prestasi Mahasiswa',
  favicon: 'img/favicon.ico',

  url: 'http://localhost:3000',
  baseUrl: '/',

  onBrokenLinks: 'warn',

  headTags: [
    {
      tagName: 'link',
      attributes: {rel: 'preconnect', href: 'https://fonts.googleapis.com'},
    },
    {
      tagName: 'link',
      attributes: {rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: 'anonymous'},
    },
    {
      tagName: 'link',
      attributes: {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400..700;1,9..144,400..700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap',
      },
    },
  ],

  i18n: {
    defaultLocale: 'id',
    locales: ['id'],
  },

  presets: [
    [
      'classic',
      {
        docs: {
          sidebarPath: './sidebars.ts',
          routeBasePath: '/',
        },
        blog: false,
        theme: {
          customCss: './src/css/custom.css',
        },
      } satisfies Preset.Options,
    ],
  ],

  themes: ['@docusaurus/theme-mermaid'],

  markdown: {
    mermaid: true,
  },

  themeConfig: {
    colorMode: {
      defaultMode: 'dark',
      disableSwitch: true,
      respectPrefersColorScheme: false,
    },
    navbar: {
      title: 'Prestasi Mahasiswa',
      logo: {
        alt: 'Logo',
        src: 'img/logo.svg',
      },
      items: [
        {to: '/', label: 'Beranda', position: 'left'},
        {to: '/flutter/overview', label: 'Aplikasi Flutter', position: 'left'},
        {to: '/laravel/overview', label: 'Web Laravel', position: 'left'},
        {to: '/database/erd', label: 'Database', position: 'left'},
        {to: '/flowchart/sistem', label: 'Flowchart', position: 'left'},
        {to: '/api/reference', label: 'API', position: 'left'},
      ],
    },
    footer: {
      style: 'dark',
      links: [
        {
          title: 'Dokumentasi',
          items: [
            {label: 'Aplikasi Flutter', to: '/flutter/overview'},
            {label: 'Web Laravel', to: '/laravel/overview'},
            {label: 'Database', to: '/database/erd'},
            {label: 'API Reference', to: '/api/reference'},
          ],
        },
        {
          title: 'Lainnya',
          items: [
            {label: 'Flowchart Sistem', to: '/flowchart/sistem'},
            {label: 'Panduan Menjalankan', to: '/panduan/menjalankan'},
            {label: 'Deployment', to: '/deployment/arsitektur'},
          ],
        },
      ],
      copyright: `Copyright © ${new Date().getFullYear()} Sistem Pencatatan Prestasi Mahasiswa. Dibuat dengan Docusaurus.`,
    },
    prism: {
      theme: prismThemes.github,
      darkTheme: prismThemes.dracula,
    },
    mermaid: {
      theme: {light: 'base', dark: 'base'},
      options: {
        theme: 'base',
        themeVariables: {
          darkMode: true,
          background: '#121722',
          mainBkg: '#121722',
          nodeBorder: '#34d399',
          nodeTextColor: '#e2e8f0',
          primaryColor: '#0f172a',
          primaryTextColor: '#e2e8f0',
          primaryBorderColor: '#34d399',
          secondaryColor: '#1e293b',
          tertiaryColor: '#171e2c',
          lineColor: '#64748b',
          textColor: '#c7cdd9',
          clusterBkg: '#0f131c',
          clusterBorder: '#2e3a52',
          edgeLabelBackground: '#0f131c',
          titleColor: '#eef1f7',
          fontSize: '14px',
        },
      },
    },
  } satisfies Preset.ThemeConfig,
};

export default config;

<?php

namespace App\Services;

class SidebarMenu
{
    public static function getMenus()
    {
        return [
            [
                'title' => 'Dashboard',
                'url' => route('dashboard'),
                'icon' => 'layout-grid-circles',
                'roles' => ['admin', 'dosen', 'mahasiswa'],
                'is_active' => request()->routeIs('dashboard')
            ],
            [
                'title' => 'Krs',
                'url' => route('krs'),
                'icon' => 'graduation-cap',
                'roles' => ['dosen', 'mahasiswa'],
                'is_active' => request()->routeIs('krs')
            ],
            [
                'title' => 'Jadwal',
                'url' => route('jadwal'),
                'icon' => 'calendar',
                'roles' => ['dosen', 'mahasiswa'],
                'is_active' => request()->routeIs('jadwal')
            ],
            [
                'title' => 'Kelola User',
                'url' => route('kelola.user'),
                'icon' => 'users',
                'roles' => ['admin'],
                'is_active' => request()->routeIs('kelola.user')
            ],
            [
                'title' => 'Kelola Matakuliah',
                'url' => route('kelola.matakuliah'),
                'icon' => 'book',
                'roles' => ['admin'],
                'is_active' => request()->routeIs('kelola.matakuliah')
            ],
            [
                'title' => 'Kelola Prodi',
                'url' => route('kelola.prodi'),
                'icon' => 'graduation-cap',
                'roles' => ['admin'],
                'is_active' => request()->routeIs('kelola.prodi')
            ],
            [
                'title' => 'Kelola Akademik',
                'url' => route('kelola.akademik'),
                'icon' => 'calendar',
                'roles' => ['admin'],
                'is_active' => request()->routeIs('kelola.akademik')
            ]
        ];
    }
}
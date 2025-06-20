<?php

if (!function_exists('formatNamaHakAkses')) {
    function formatNamaHakAkses(string $nama): string
    {
        $parts = explode('-', $nama);
        $prefix = str_replace('_', ' ', $parts[0] ?? $nama);
        $action = $parts[1] ?? '';
        return $action ? "{$prefix} ({$action})" : $prefix;
    }
}

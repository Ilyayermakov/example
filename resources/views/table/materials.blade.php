@extends('layouts.auth-admin')

@section('page.title', 'Материалы')

<x-table.table-materials-only :materials="$materials"></x-table.table-materials-only>

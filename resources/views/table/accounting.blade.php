@extends('layouts.auth-admin')

@section('page.title', 'Бухгалтерия')

<x-table.table-accounting-only :accounting="$accounting"></x-table.table-accounting-only>

@extends('layouts.auth-admin')

@section('page.title', 'Записи')

<x-table.table-records-only :recordsT="$recordsT" :procedures="$procedures" :clients="$clients"></x-table.table-records-only>

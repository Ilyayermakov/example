@extends('layouts.auth-admin')

@section('page.title', 'Процедуры')

<x-table.table-procedures-only :procedures="$procedures"></x-table.table-procedures-only>

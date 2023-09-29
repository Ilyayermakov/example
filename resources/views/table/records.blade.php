@extends('layouts.auth-admin')

@section('page.title', 'Прошлые Записи')

<x-table.table-pastrecords-only :recordsF="$recordsF"></x-table.table-pastrecords-only>

@extends('layouts.auth-admin')

@section('page.title', 'Клиенты')

<x-table.table-clients-only :clients="$clients"></x-table.table-clients-only>

@extends('layouts.main')

@section('page.title', 'Message')

<x-title-table>
    <h5>{{__('Здравствуйте ') . $name . __('. На указаную Вами почту ') .$email . __(' выслано письмо.')}}</h5>
</x-title-table>


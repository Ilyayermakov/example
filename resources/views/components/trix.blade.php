<input type="hidden"{{ $attributes }}" id="{{ $name }}">
<trix-editor  input="{{ $name }}"></trix-editor>
<style>
    .trix-button-group--file-tools {
      display: none !important;
    }
  </style>


@once
    @push('css')
        <link rel="stylesheet" href="http://localhost/laravel/onecode/public/css/trix.css">
    @endpush
    @push('js')
        <script src="http://localhost/laravel/onecode/public/js/trix.js"></script>
    @endpush
@endonce

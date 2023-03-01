<footer>
    @routes
    @stack('before-scripts')
    {!! script('/src/public/js/manifest.js') !!}
    {!! script('/src/public/js/vendor.js') !!}
    {!! script('/src/public/js/core.js') !!}
    {!! script('vendor/summernote/summernote-bs4.js') !!}
    @stack('after-scripts')
</footer>

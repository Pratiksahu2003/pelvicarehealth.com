@php
    $editorId = $id ?? 'editor';
@endphp
<div class="quill-editor-wrapper" data-editor-id="{{ $editorId }}" data-placeholder="{{ $placeholder ?? 'Start writing your content...' }}" data-height="{{ $height ?? '400px' }}">
    <div id="{{ $editorId }}" style="height: {{ $height ?? '400px' }};">
        {!! $content ?? '' !!}
    </div>
    <input type="hidden" name="{{ $name }}" id="{{ $editorId }}-input" value="{{ $value ?? '' }}">
</div>

@once
@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .quill-editor-wrapper .ql-container {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
    }
    .quill-editor-wrapper .ql-editor {
        min-height: 120px;
    }
    .quill-editor-wrapper .ql-toolbar {
        background: #f9fafb;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        border: 1px solid #e5e7eb;
    }
    .quill-editor-wrapper .ql-container {
        border-bottom-left-radius: 0.75rem;
        border-bottom-right-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        border-top: none;
    }
    .quill-editor-wrapper .ql-editor.ql-blank::before {
        color: #9ca3af;
        font-style: normal;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var wrappers = document.querySelectorAll('.quill-editor-wrapper:not(.quill-initialized)');
    wrappers.forEach(function(wrapper) {
        var editorId = wrapper.getAttribute('data-editor-id');
        var placeholder = wrapper.getAttribute('data-placeholder') || 'Start writing your content...';
        var quillContainer = document.getElementById(editorId);
        var hiddenInput = document.getElementById(editorId + '-input');
        if (!quillContainer || !hiddenInput) return;

        var quill = new Quill('#' + editorId, {
            theme: 'snow',
            placeholder: placeholder,
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    [{ 'font': [] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        wrapper.classList.add('quill-initialized');

        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            if (html === '<p><br></p>') html = '';
            hiddenInput.value = html;
        });

        if (hiddenInput.value) {
            quill.root.innerHTML = hiddenInput.value;
        }

        var form = wrapper.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                var html = quill.root.innerHTML;
                if (html === '<p><br></p>') html = '';
                hiddenInput.value = html;
            });
        }
    });
});
</script>
@endpush
@endonce

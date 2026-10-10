<div class="tinymce-editor-wrapper">
    <textarea name="{{ $name }}" id="{{ $id ?? 'tinymce-content' }}" class="tinymce-textarea" style="min-height: {{ $height ?? '500px' }};">{!! $value ?? '' !!}</textarea>
</div>

@push('styles')
<style>
    .tinymce-editor-wrapper .tox-tinymce { border-radius: 0.75rem; border-color: #e5e7eb; }
    .tinymce-editor-wrapper .tox .tox-edit-area__iframe { background: #fff; }
</style>
@endpush

@push('scripts')
@php
    $tinymceApiKey = config('services.tinymce.api_key') ?: 'nw1gvxnimln6t5db7bprxottb76hjevrnasm6664q9si36om';
@endphp
<script src="https://cdn.tiny.cloud/1/{{ $tinymceApiKey }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var editorId = '{{ $id ?? 'tinymce-content' }}';
    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    var uploadUrl = '{{ $uploadUrl ?? route("admin.blog.upload-image") }}';

    tinymce.init({
        selector: '#' + editorId,
        height: parseInt('{{ $height ?? "500" }}'.replace('px','')) || 500,
        menubar: true,
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            'image', 'advlist', 'preview', 'code', 'fullscreen', 'insertdatetime', 'help'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | code fullscreen | help',
        content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; line-height: 1.8; color: #374151; padding: 20px; max-width: 800px; margin: 0 auto; } img { max-width: 100%; height: auto; border-radius: 8px; }',
        promotion: false,
        branding: false,
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('_token', csrfToken);
                xhr.open('POST', uploadUrl);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.upload.onprogress = function (e) { if (e.lengthComputable) progress(e.loaded / e.total * 100); };
                xhr.onload = function () {
                    if (xhr.status === 403) { reject('HTTP Error: ' + xhr.status); return; }
                    if (xhr.status < 200 || xhr.status >= 300) { reject('HTTP Error: ' + xhr.status); return; }
                    var json = JSON.parse(xhr.responseText);
                    resolve(json.location || reject('Invalid JSON: ' + xhr.responseText));
                };
                xhr.onerror = function () { reject('Image upload failed'); };
                xhr.send(formData);
            });
        }
    });
});
</script>
@endpush

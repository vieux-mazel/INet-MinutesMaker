tinymce.init({
    selector: "textarea",
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    },
    theme: "modern",
    skin: 'light',
    plugins: [
        "autolink lists charmap preview hr anchor pagebreak",
        "wordcount visualblocks visualchars fullscreen",
        "media nonbreaking directionality",
        "emoticons paste textpattern"
    ],
    toolbar1: "bullist numlist | bold italic underline | emoticons | styleselect | preview",
    menubar : false,
    fontsize_formats: "12pt 14pt 15pt 16pt 18pt 24pt 30pt",
    height : 400,

});

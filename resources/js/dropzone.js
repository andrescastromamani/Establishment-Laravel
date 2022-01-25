document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('#dropzone')) {
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone('div#dropzone', {
            url: '/images/store',
            paramName: 'image',
            maxFilesize: 10,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: function (file, response) {
                //console.log(file);
                console.log(response);
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value);
                console.log('sending');
            },
        });
    }
});

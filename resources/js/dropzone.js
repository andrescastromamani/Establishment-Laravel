document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('#dropzone')) {
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone('div#dropzone', {
            url: '/images/store',
            maxFilesize: 10,
            required: true,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            success: function (file, response) {
                //console.log(file);
                file.nameServer = response.path;
                console.log(response);
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value);
                console.log('sending');
            },
            removedfile: function (file, response) {
                console.log(file);
                const params = {
                    image: file.nameServer,
                }
                axios.post('/images/delete', params)
                    .then(function (response) {
                        console.log(response);
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        });
    }
});

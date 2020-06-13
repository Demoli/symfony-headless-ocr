<template>
    <div>
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
    </div>
</template>
<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        name: 'Uploader',
        components: {
            vueDropzone: vue2Dropzone
        },
        props: {
            fileIds: Array
        },
        data: function () {
            let self = this;
            return {
                dropzoneOptions: {
                    url: 'http://docker.ocr-queue.com/api/upload',
                    thumbnailWidth: 200,
                    maxFilesize: 10,
                    success: function (file, response) {
                        self.fileIds.push(response);
                    }
                },
            }
        }
    }
</script>
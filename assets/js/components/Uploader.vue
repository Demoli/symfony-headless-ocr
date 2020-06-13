<template>
    <div>
        <p v-if="fileId">
            Your image has been uploaded, your file ID is {{fileId}}
        </p>
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
        data: function () {
            let self = this;
            return {
                fileId: null,
                dropzoneOptions: {
                    url: 'http://docker.ocr-queue.com/api/upload',
                    thumbnailWidth: 200,
                    maxFilesize: 10,
                    success: function (file, response) {
                        self.fileId = response;
                    }
                    // headers: {"My-Awesome-Header": "header value"}
                },
            }
        }
    }
</script>
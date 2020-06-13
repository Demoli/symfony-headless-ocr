<template>
    <div>
        <p v-if="files.length">
            Your uploaded file IDs are below, please remain on this page for your results:
        </p>
        <ul>
            <li v-for="fileId in files">
                <span>{{fileId}}</span>
            </li>
        </ul>
        <uploader v-bind:files.sync="files" />
    </div>
</template>

<script>
    import Uploader from "../components/Uploader";

    export default {
        components: {
            uploader: Uploader
        },
        data: function () {
            return {
                files: []
            }
        }
    };
</script>

<style>
    .center {
        text-align: center;
    }
</style>
<template>
    <div>
        <p v-if="fileIds.length">
            Your uploaded file IDs are below, please remain on this page for your results:
        </p>
        <h2>Queued Files</h2>
        <ul>
            <li v-for="fileId in fileIds">
                <span>{{fileId}}</span>
            </li>
        </ul>
        <h2>Results</h2>
        <ul>
            <li v-for="fileResult in fileResults">
                <p>{{fileResult.fileId}}</p>
                <p>{{fileResult.resultText}}</p>
            </li>
        </ul>
        <h2>Upload Files</h2>
        <uploader v-bind:fileIds.sync="fileIds"/>
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
                polling: null,
                fileIds: [],
                fileResults: [],
            }
        },
        methods: {
            pollData() {
                let self = this;
                this.polling = setInterval(() => {
                    if (self.fileIds.length === 0) {
                        return;
                    }
                    let fileIds = self.fileIds.join(',');
                    this.$axios.get(`/result/${fileIds}`)
                        .then(function (response) {
                            response.data.forEach(function (fileResult) {
                                let id = fileResult.fileId;
                                self.fileIds.splice(self.fileIds.indexOf(id), 1);
                                self.fileResults.push(fileResult);
                            });
                        })
                }, 3000)
            }
        },
        beforeDestroy() {
            clearInterval(this.polling)
        },
        created() {
            this.pollData();
        }
    };
</script>

<style>
    .center {
        text-align: center;
    }
</style>
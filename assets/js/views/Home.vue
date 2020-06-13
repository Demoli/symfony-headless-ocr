<template>
    <div>
        <h2>Upload Files</h2>
        <uploader v-bind:fileIds.sync="fileIds" v-bind:filenames.sync="filenames"/>
        <div v-if="fileIds.length">
            <p>
                Your uploaded file IDs are below, please remain on this page for your results:
            </p>
            <h2>Queued Files</h2>
            <p>Your files are in the queue, please wait</p>
            <ul>
                <li v-for="name in filenames">
                    <span>{{name}}</span>
                </li>
            </ul>
        </div>
        <div v-if="fileResults.length">
            <h2>Results</h2>
            <ul>
                <li v-for="fileResult in fileResults">
                    <p>{{fileResult.name}}</p>
                    <p>{{fileResult.resultText}}</p>
                </li>
            </ul>
        </div>
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
                filenames: [],
                fileResults: [],
            }
        },
        watch: {
            fileIds: function (val) {
                this.saveLocalData();
            },
            filenames: function (val) {
                this.saveLocalData();
            },
            fileResults: function (val) {
                this.saveLocalData();
            },
        },
        methods: {
            saveLocalData: function () {
                let data = this.$data;
                delete data['polling'];
                localStorage.localData = JSON.stringify(data);
            },
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
                                let fileIndex = self.fileIds.indexOf(id);
                                fileResult.name = self.filenames[fileIndex];
                                self.fileIds.splice(fileIndex, 1);
                                self.filenames.splice(fileIndex, 1);
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
        },
        mounted() {
            let localData = localStorage.localData;
            if (localData) {
                localData = JSON.parse(localData);
                for (let prop in localData) {
                    this[prop] = localData[prop];
                }
            }
        }
    };
</script>

<style>
    .center {
        text-align: center;
    }
</style>
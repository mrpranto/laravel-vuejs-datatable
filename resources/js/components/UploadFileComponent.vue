<template>
    <div class="card">
        <div class="card-header h5">
            Upload Multiple Files
        </div>
        <div class="card-body">
            <div class="alert alert-success" v-if="success">
                {{ success }}
            </div>
            <div class="alert alert-danger" v-if="Object.keys(errors).length > 0">
                <ul>
                    <li v-for="(error, indx) in errors" :key="indx">{{ errors[indx][0] }}</li>
                </ul>
            </div>
            <form @submit.prevent="uploadFile">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Multiple File</label>
                    <input class="form-control" type="file" id="formFile" multiple @change="getFile">
                </div>
                <div class="mb-3">
                    <button class="btn btn-info" type="submit">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: "UploadFileComponent",
    components: {},
    data() {
        return {
            formData: new FormData(),
            success:'',
            errors:[],
            files: []
        }
    },
    mounted() {

    },
    watch: {},
    methods: {
        uploadFile() {
            for( let i = 0; i < this.files.length; i++ ){
                let file = this.files[i];
                this.formData.append('files[' + i + ']', file);
            }
            axios.post('/api/upload-files', this.formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    if (response.data.error){
                        this.errors = response.data.error
                    }else {
                        this.success = response.data.success
                    }
                })
                .catch(e => {
                    console.log(e)
                })
        },
        getFile(event) {
            this.files = event.target.files
        }
    }
}
</script>

<style scoped>
.column_disable {
    background-color: #767b80;
    color: white;
}

.sort {
    text-decoration: none;
    color: black;
}
</style>

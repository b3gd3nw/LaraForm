<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="POST" id="form">
                    <p>
                        <label for="company">Company</label>
                        <input
                            class="form-control"
                            v-model="company"
                            id="company"
                            type="text"
                            name="company"
                        >
                    </p>
                    <p>
                        <label for="position">Position</label>
                        <input
                            class="form-control"
                            v-model="position"
                            id="position"
                            type="text"
                            name="position"
                        >
                    </p>
                    <p>
                        <label for="aboutme">About Me</label>
                        <textarea
                            class="form-control"
                            v-model="aboutme"
                            id="aboutme"
                            type="text"
                            name="aboutme"

                        ></textarea>
                    </p>
                    <p>
                        <label for="photo">Photo</label>
                        <input
                            class="form-control"
                            id="photo"
                            v-on:change="handleFileUpload($event)"
                            type="file"
                            name="photo"
                            accept="image/*"
                            ref="photo"
                        >
                    </p>
                    <a @click="send" class="btn btn-primary btn-next">Next</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            company: '',
            position: '',
            aboutme: '',
            photo: ''
        }
    },
    methods: {
        send() {
            let formData = new FormData();
            formData.append('company', this.company);
            formData.append('position', this.position);
            formData.append('aboutme', this.aboutme);
            formData.append('photo', this.photo);
            console.log(formData);
            axios.post(
                '/api/submit_profile', {
                    formData,
                    'headers': {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(responce=> {
                if(responce['data'] === 200){
                    this.$cookie.set('step', 'three', 1);
                    this.$router.push('social');
                }
            });
        },
        handleFileUpload(event){
            this.photo = event.target.files[0];
        }
    }
}
</script>

<style scoped>
label {
    float: left;
}
.btn-next {
    float: right;
}
</style>

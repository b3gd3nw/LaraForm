<template>
    <div class="container">
        <div class="title text-center">
            <h2>
                To participate in the conference, please fill out the form
            </h2>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="POST" id="form">
                    <p>
                        <label for="company">Company</label>
                        <input
                            class="form-control"

                            id="company"
                            type="text"
                            name="company"
                        >
                    </p>
                    <p>
                        <label for="position">Position</label>
                        <input
                            class="form-control"

                            id="position"
                            type="text"
                            name="position"
                        >
                    </p>
                    <p>
                        <label for="aboutme">About Me</label>
                        <textarea
                            class="form-control"

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
    methods: {
        send() {
            let formData = new FormData(document.getElementById('form'));
            axios.post('/api/submit_profile', formData)
                .then(responce=> {
                if(responce['data'] === 200){
                    this.$cookie.set('step', 'first', 1);
                    this.$router.push('social');

                }
            });
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

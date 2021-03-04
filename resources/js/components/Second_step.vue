<template>
    <div class="container">
        <div class="title text-center">
            <h2>
                To participate in the conference, please fill out the form
            </h2>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <ValidationObserver v-slot="{ handleSubmit }">
                    <form @submit.prevent="handleSubmit(send)" method="POST" id="form">
                    <p>
                        <label for="company">Company</label>
                        <ValidationProvider rules="max:20|min:1" v-slot="{ errors }">
                            <input
                                class="form-control"
                                v-model="formData.company"
                                id="company"
                                type="text"
                                name="company"
                            >
                            <span class="text-danger">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </p>
                    <p>
                        <label for="position">Position</label>
                        <ValidationProvider rules="max:20|min:1" v-slot="{ errors }">
                            <input
                                class="form-control"
                                v-model="formData.position"
                                id="position"
                                type="text"
                                name="position"
                            >
                            <span class="text-danger">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </p>
                    <p>
                        <label for="aboutme">About Me</label>
                        <ValidationProvider rules="max:200|min:1" v-slot="{ errors }">
                            <textarea
                                class="form-control"
                                v-model="formData.aboutme"
                                id="aboutme"
                                type="text"
                                name="aboutme"
                            ></textarea>
                            <span class="text-danger">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </p>
                    <p>
                        <label for="photo">Photo</label>
                        <ValidationProvider rules="mimes:image/*" v-slot="{ errors, validate }">
                            <input
                                class="form-control"
                                @change="validate"
                                id="photo"
                                type="file"
                                name="photo"
                                accept="image/*"
                                ref="photo"
                            >
                            <span class="text-danger">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </p>
                    <button type="submit" class="btn btn-primary btn-next">Next</button>
                </form>
                </ValidationObserver>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        formData: {
            company: '',
            position: '',
            aboutme: '',
            photo: null,
        }
    }),
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

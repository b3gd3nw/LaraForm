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
                        <label for="firstname">First Name</label>
                        <input
                            class="form-control"
                            id="firstname"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="lastname">Last Name</label>
                        <input
                            class="form-control"
                            id="lastname"
                            type="text"
                            name="lastname"
                        >
                    </p>
                    <p>
                        <label for="birthdate">Birth Date</label>
                        <input
                            class="form-control"
                            id="birthdate"
                            type="date"
                            name="birthdate"
                        >
                    </p>
                    <p>
                        <label for="reportsubject">Report Subject</label>
                        <input
                            class="form-control"
                            id="reportsubject"
                            type="text"
                            name="reportsubject"
                        >
                    </p>
                    <p>
                        <label for="countryId">Country</label>
                        <select name="countryId" id="countryId" class="form-control">
                            <option :value="country['id']" v-for="country in countries_data" :key="country['id']">
                                {{ country['name'] }}
                            </option>
                        </select>
                    </p>
                    <p>
                        <label for="phone">Phone</label>
                        <input
                            class="form-control"
                            id="phone"
                            type="text"
                            name="phone"
                        >
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input
                            class="form-control"
                            id="email"
                            type="email"
                            name="email"
                        >
                    </p>
                    <a @click="send" class="btn btn-primary btn-next">Next</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, between } from 'vuelidate/lib/validators'

export default {
    props : {
        countries_data: {
            type: Object.Array,
            default(){
                return {}
            }
        }
    },
    methods: {
        send() {
            let formData = new FormData(document.getElementById("form"));
            axios.post(
                '/api/submit_member', formData)
                .then(responce=> {
                if(responce['data'] === 200){
                    this.$cookie.set('step', 'second', 1);
                    this.$router.push('second');
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

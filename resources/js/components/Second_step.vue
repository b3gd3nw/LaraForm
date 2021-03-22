<template>
    <div class="container">
        <div class="title text-center">
            <h2>
                To participate in the conference, please fill out the form
            </h2>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <ValidationObserver v-slot="{ handleSubmit }" ref="observer">
                    <form @submit.prevent="handleSubmit(send)" method="POST" id="form">
                    <p>
                        <label for="company">Company</label>
                        <ValidationProvider rules="max:200|min:1" v-slot="{ errors }">
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
                        <ValidationProvider rules="max:200|min:1" v-slot="{ errors }">
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
                        <ValidationProvider rules="ext:png,jpg|size:2000" v-slot="{ errors, validate }">
                          <div class="group">
                            <input
                                class="form-control"
                                @change="validate"
                                id="photo"
                                type="file"
                                name="photo"
                                accept="image/*"
                                ref="photo"
                            >
                            <a @click="clear_photo" class="btn btn-outline-danger clear-btn">x</a>
                          </div>
                            <span class="text-danger">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </p>
                    <button type="submit" class="btn btn-primary btn-next">Next</button>
                      <input type="hidden" name="_method" value="PUT">
                    </form>
                </ValidationObserver>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
      errors: [],
      observer: '',
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
            axios.post(`/api/members/${ this.getCookie('userid') }`, formData)
                .then(responce=> {
                if(responce['data'] === 200){
                    this.$cookie.set('step', 'first', 1);
                    this.$router.push('social');

                }
            });

        },
        getCookie(cname) {
          let name = cname + "=";
          let decodedCookie = decodeURIComponent(document.cookie);
          let ca = decodedCookie.split(';');
          for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
              c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
              return c.substring(name.length, c.length);
            }
          }
          return "";
        },
        clear_photo() {
          document.getElementById("photo").value = null;
          this.$refs.photo = null;
          this.$refs.observer.reset();
          let event = new Event('change')
          document.getElementById("photo").dispatchEvent(event);
          }

    }
}
</script>

<style scoped>
.group {
  position: relative;
}
.clear-btn {
  border-radius: 50px;
  width: 25px;
  height: 25px;
  padding: 0;
  position: absolute;
  top: 30px;
  right: 10px;
  color: red;
}

label {
    float: left;
}
.btn-next {
    float: right;
}
</style>

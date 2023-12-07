<template>
    <div>
      <v-card
        class="mx-auto pa-12 pb-8"
        elevation="8"
        max-width="448"
        rounded="lg"
      >
      <div class="text-subtitle-1 text-medium-emphasis">GALLERY APP</div>
        <div class="text-subtitle-1 text-medium-emphasis">Account</div>
  
        <v-text-field
          density="compact"
          placeholder="Email address"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
        ></v-text-field>
  
        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Password
  
          <a
            class="text-caption text-decoration-none text-blue"
            href="#"
            rel="noopener noreferrer"
            target="_blank"
          >
            Forgot login password?</a>
        </div>
  
        <v-text-field
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          @click:append-inner="visible = !visible"
        ></v-text-field>
  
        <v-card
          class="mb-12"
          color="surface-variant"
          variant="tonal"
        >
          <v-card-text class="text-medium-emphasis text-caption">
            Warning: After 3 consecutive failed login attempts, you account will be temporarily locked for three hours. If you must login now, you can also click "Forgot login password?" below to reset the login password.
          </v-card-text>
        </v-card>
  
        <v-btn
          block
          class="mb-8"
          color="blue"
          size="large"
          variant="tonal"
          @click="gotoHome()"
        >
          Log In
        </v-btn>
  
 
      </v-card>
    </div>
  </template>

<script>
import '@mdi/font/css/materialdesignicons.css';
import axios from 'axios'
export default {
    name: "LoginPanel",
    data() {
        return {
            tabs: [{
                    name: "Login",
                    icon: "mdi-account"
                },
                {
                    name: "Register",
                    icon: "mdi-account-outline"
                }
            ],
            Login_form: {
                email: '',
                password: ''
            },
            error: [],
            emailRules: [
                (v) => !!v || 'Email is required',
                (v) => /.+@.+/.test(v) || 'Email must be valid',
            ],
            confirmPasswordRules1: [
                (v) => !!v || 'Confirm password is required',
                (v) => v === this.password || 'Passwords do not match',
            ]
        }

    },
    computed: {
        passwordRules() {
            return [
                (value) => !!value || 'Password is required',
                (value) => value.length >= 8 || 'Password must be at least 8 characters long',
            ];
        },
        confirmPasswordRules() {
            return [
                (value) => !!value || 'Please confirm your password',
                (value) => value === this.register_form.password || 'Passwords do not match',
            ];
        },
    },

    methods: {
        form_validation() {
            this.error = []

        },
        gotoHome(){
          this.$router.push('/Main')
        },

        default_setting() {
            this.register_form.email = ''
            this.register_form.password = ''
            this.register_form.confirmpassword=''
            this.Login_form.email=''
            this.Login_form.password=''

        },

        async UserLogin() {
            let result = await axios.post("http://0.0.0.0:8000/api/SignUpUser", {
                'email': this.Login_form.email,
                'password': this.Login_form.password
            });
            console.warn(result["data"]["message"]);
            this.text=result["data"]["message"];
            this.snackbar=true;
            this.default_setting();
            if (result["data"]["loginstatus"] == "1")
            {
                this.$router.push('/Home');
            }
        }
    }
}
</script>

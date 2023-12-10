<template>

    <v-card background-color="pink" class="w-screen h-screen" style="background-color: white;">
        <v-toolbar style="background-color:white">
            <template v-slot:extension>
                <v-row class="d-flex justify-center">
                    <v-tabs v-model="model">

                        <v-tab class="d-flex align-center">
                            <v-text> LOGIN </v-text>
                        </v-tab>
                        <v-tab class="d-flex align-center">
                            <v-text> REGISTER </v-text>
                        </v-tab>
                    </v-tabs>
                </v-row>
            </template>
        </v-toolbar>

        <v-window v-model="model">
            <v-window-item>
                <v-card class="mx-auto pa-12 pb-3 w-100 h-100 d-flex flex-column align-center justify-center" elevation="8" rounded="lg">
                    <div class="w-100 h-100 pb-2 text-center">
                    </div>

                    <div class="w-100">
                        <div class="text-subtitle-1 text-medium-emphasis ">Account</div>
                        <v-text-field density="compact" placeholder="Email address" prepend-inner-icon="mdi-email-outline" variant="outlined" v-model="Login_form.email" :rules="emailRules"></v-text-field>
                        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
                            Password
                        </div>

                        <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'" density="compact" placeholder="Enter your password" prepend-inner-icon="mdi-lock-outline" variant="outlined" @click:append-inner="visible = !visible" v-model="Login_form.password"></v-text-field>
                        <v-btn block class="mb-8" color="blue" size="large" variant="tonal" v-on:click="UserLogin()">
                            Log In
                        </v-btn>

                    </div>
                </v-card>
            </v-window-item>

            <v-window-item >
                <v-card class="mx-auto pl-10 pr-10 pb-5 w-100 h-100 d-flex flex-column align-center justify-center" elevation="8" rounded="lg">
                    <div class="w-100 pb-2 text-center">
                    </div>

                    <div class="w-100 ">
                        <div class="text-subtitle-2 text-medium-emphasis ">Name</div>
                        <v-text-field density="compact" placeholder="User Name" prepend-inner-icon="mdi-email-outline" variant="outlined" v-model="register_form.name" required ></v-text-field>


                        <div class="text-subtitle-2 text-medium-emphasis ">Email</div>
                        <v-text-field density="compact" placeholder="Email address" prepend-inner-icon="mdi-email-outline" variant="outlined" v-model="register_form.email" required :rules="emailRules"></v-text-field>

                        <div class="text-subtitle-2 text-medium-emphasis d-flex align-center justify-space-between">
                            Password
                        </div>

                        <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'" density="compact" placeholder="Enter your password" prepend-inner-icon="mdi-lock-outline" variant="outlined" @click:append-inner="visible = !visible" v-model="register_form.password" :rules="passwordRules" required></v-text-field>

                        <div class="text-subtitle-2 text-medium-emphasis d-flex align-center justify-space-between">
                            Confirm Password
                        </div>
                        <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'" density="compact" placeholder="Confirm your password" prepend-inner-icon="mdi-lock-outline" variant="outlined" @click:append-inner="visible = !visible" v-model="register_form.password_confirmation" :rules="confirmPasswordRules" required></v-text-field>
                        <v-btn block class="mb-8" color="blue" size="large" variant="tonal" v-on:click="RegisterUser()">
                            REGISTER
                        </v-btn>

                    </div>

                </v-card>
            </v-window-item>
        </v-window>

        <v-snackbar v-model="snackbar" :timeout="timeout">
            {{ text }}

            <template v-slot:actions>
                <v-btn color="blue" variant="text" @click="snackbar = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </v-card>
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
                snackbar: false,
                text: '',
                timeout: 2000,
                model: 'tab-2',
                visible: false,

                register_form: {
                    name:'',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                Login_form: {
                    email: '',
                    password: '',
                    device_name: 'browser'
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
            default_setting() {
                this.register_form.email = ''
                this.register_form.password = ''
                this.register_form.confirmpassword=''
                this.Login_form.email=''
                this.Login_form.password=''

            },
            async RegisterUser() {

                await axios.post('http://127.0.0.1:8000/api/RegisterUser', this.register_form).then((response) => {
                    console.log(response.data)
                    this.register_form.name = this.register_form.email = this.register_form.password = this.register_form.password_confirmation = ''
                    this.errors = {}
                    alert('REGISTERATION SUCESSFULL')
                    //this.$router.push('/login')
                    //this.$toaster.success('Account created successfully, now you can login!')
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                    console.log(errors.response.data.errors)
                });


            },
            async UserLogin() {
               await axios.post('http://127.0.0.1:8000/api/AuthUser', this.Login_form).then((response) => {
                    localStorage.setItem('token', response.data)
                    //localStorage.removeItem("token");
                    alert(localStorage.getItem("token"))
                    this.$router.push('/Main')
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            }


        }
    }
    </script>

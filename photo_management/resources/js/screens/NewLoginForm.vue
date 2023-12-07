<template>
    <v-app style="background-color: #140E39;" >
   <v-layout >
  <v-col md="7" class="d-flex align-center w-screen h-screen">

    <img src="../../Images/loginlogo.png" class="pa-16 d-flex align-center w-screen h-screen"  > 

  </v-col>

  <v-col md="5" class="d-flex justify-center align-center w-screen h-screen" >
    
    <LoginForm />

  </v-col>
    </v-layout>
</v-app>

</template>

<script>
import LoginForm from '../component/LoginForm.vue';
import '@mdi/font/css/materialdesignicons.css';
export default {
    name: "newlogin",
    components: {
        LoginForm
    },
    methods:{
      getformdata()
      {
        
      }
    }
}
</script>

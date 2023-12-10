<template >

<v-layout class="d-flex justify-center pa-16 backgroundlogin">
<v-card class="d-flex justify-center" style="background-color: rgb(0, 0, 0);">
    <v-row
        align="center"
        no-gutters
        class="d-flex h-auto w-auto"
      >
      <v-col class="d-flex justify-center " md="6" style="background-color: aquamarine;" >

    <v-sheet style="background-color: black;" >
        <v-img
        class="rounded-lg"
        :width="450"
        :height="650"


       cover
        src="https://images.unsplash.com/photo-1572947650440-e8a97ef053b2?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGFydCUyMGdhbGxlcnl8ZW58MHx8MHx8fDA%3D"
        ></v-img>
          </v-sheet>

      </v-col>





      <v-col md="6">
        <v-sheet>
        <LoginPanel/>
      </v-sheet>
      </v-col>


      </v-row>
</v-card>

</v-layout>
</template>
<script>
 import LoginPanel from "../component/LoginForm.vue"
export default{
    name :"Login",
    components:{
        LoginPanel

    },
    methods:{

    }
}

</script>

<style scoped>
.backgroundlogin{
    background: url('../../Images/bg1.jpg');
    background-size: cover;
  height: 100vh;
}

</style>

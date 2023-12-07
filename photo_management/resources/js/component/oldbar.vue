<template>
    <v-layout>
      <v-row>
        <v-col md="2">
          <!-- Add a v-bind:class to conditionally apply the class based on the sidebar state -->
          <v-navigation-drawer
            theme="dark"
            permanent
           
            :class="{ 'w-0': !isSidebarOpen }"
            style="background-color: #140E39; width: 350px;"
          >
                <v-list color="transparent">
                    <v-list-item class="temp">Talent Hunter</v-list-item>
                    <v-list-item style="font-weight: bold;" class="ml-6 mb-6">{{ email }}</v-list-item>
                    <v-divider class="mt-3 mb-4"></v-divider>
                    <v-subheader style="color:lightgray;" class="ml-10 mb-10">Menu</v-subheader>
                    <v-list-item @click="gotohome()" class="ml-9 text-body-1" prepend-icon="mdi-home-account" title="Home"></v-list-item>
                    <v-list-item @click="gotouploadResume()" class="ml-9 text-body-1" prepend-icon="mdi-file-upload-outline" title="Upload CVs"></v-list-item>
                    <v-list-item @click="gotodashboard()" class="ml-9 mb-6 text-body-1" prepend-icon="mdi-view-dashboard" title="Dashboard"></v-list-item>

                    <v-divider class="mt-3 mb-6"></v-divider>
                    

                
                    <v-btn class="  mt-15 ml-6 text-button" style="background-color: #140E39;font-size:x-large;">Logout</v-btn>
                </v-list>
          </v-navigation-drawer>
        </v-col>
  
        <router-view></router-view>
      </v-row>
    </v-layout>
  </template>
  
  <script>
  import '@mdi/font/css/materialdesignicons.css';
 
  export default {
    name: 'oldBar',
    data() {
      return {
        isSidebarOpen: true, 
        email:'HAMZAABBAS7007@gmail.com'
      };
    },
    methods: {

      // Method to handle screen size change
      handleResize() {
        if (window.innerWidth >= 960) {
        
          this.isSidebarOpen = true;
          
        } else {
          
          this.isSidebarOpen = false;
        }
      }
    },
    created() {
     
      this.handleResize();
    },
    mounted() {
      // Add event listener to handle screen size change
      window.addEventListener('resize', this.handleResize);
    },
    beforeDestroy() {
      // Remove event listener to prevent memory leaks
      window.removeEventListener('resize', this.handleResize);
    }

  };
  </script>
  
  <style>
 

  .temp {
    font-size: 30px;
    font-weight: bold;
    margin-top: 30px;
    margin-bottom: 70px;
    margin-left: 25px;
}

.nav_style {
    width: 400px;
}
  </style>
  
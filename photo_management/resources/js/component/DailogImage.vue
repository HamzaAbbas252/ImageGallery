<template>
    <v-row justify="space-around">
      <v-col cols="auto">
        <v-dialog
          transition="dialog-top-transition"
          width="auto"
        >
          <template v-slot:activator="{ props }">
            <v-btn
              color="primary"
              v-bind="props"
            >View Image</v-btn>
          </template>
          <template v-slot:default="{ isActive }">
            <v-card>
              <v-toolbar
                color="primary"
                title="Viewing Image"
              ></v-toolbar>
                <div class="text-h2 pa-12">
                    
<v-img
  :width="300"
  aspect-ratio="16/9"
  cover
  src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"
></v-img>
                
                </div>
              <v-card-actions class="justify-end">
                <v-btn
                  variant="text"
                  @click="isActive.value = false"
                >Close</v-btn>
              </v-card-actions>
            </v-card>
          </template>
        </v-dialog>
      </v-col>
    </v-row>
  </template>

  <script>
  export default {
    name:"Dailoged",

  }
  
  </script>
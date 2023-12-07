<template>
    <v-table fixed-header class="d-flex pa-12 w-100 h-100 " >
        <thead>
            <tr >
              <th>
                
              </th>

                <th class="text-center font-weight-black">
                    Hash_value
                </th>
                <th class="text-center font-weight-black">
                    Number_of_time_Repeated
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in Repeated_Data" :key="item.hash_value">
                <td class="text-center" >
                    {{ item.hash_value}}
                </td>
                <td class="text-center">
                    {{ item.Repeated}}
                </td>
                <td  class="d-flex ml-12">
                
        <v-btn
        class="text-none ms-4 text-white  "
        color="blue-darken-4"
        rounded="0"
        variant="flat"
        @click="DeleteButton()"
      >
        DELETE
      </v-btn>

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
              @click="ViewPhoto(item)"
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
  :src="path + photo"
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

    </td>
            </tr>
        </tbody>
    </v-table>
    </template>
    <script>
    import axios from 'axios'

    export default {
        name:"Action_Table",
        data(){
            return {
            Repeated_Data: null,
            photo:null,
            path:"http://127.0.0.1:8000/photos/"
          }
        },
        methods:{
            async GetData() {
                let result = await axios.get("http://127.0.0.1:8000/api/Repeated");
                return result.data; // Return the data property from the response object
        },
        async ViewPhoto(item) {
         //    console.log("Clicked Delete for hash_value:", item);
                 let result = await axios.post("http://127.0.0.1:8000/api/viewphoto",{"hash_value":item.hash_value});
                 this.photo=result["data"]["relative_path"]
                
            },

        DeleteButton()
        {
           this.$router.push('/delete')
        }
    },
    async mounted() {
        const data = await this.GetData(); // Correctly await the GetData method
        this.Repeated_Data = data['Repeated_photos'];
        },
}

    </script>
    
 
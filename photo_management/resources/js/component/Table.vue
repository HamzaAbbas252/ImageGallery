<template>
    <v-table fixed-header class="d-flex pa-10 w-100 " height="400px" >
        <thead>
            <tr >
                <th class="text-left font-weight-black">
                    id
                </th>
                <th class="text-left font-weight-black">
                    FileName
                </th>
                <th class="text-left font-weight-black">
                    Width
                </th>
                <th class="text-left font-weight-black">
                    Height
                </th>
                <th class="text-left font-weight-black">
                    Hash_value
                </th>

                <th class="text-center font-weight-black">
                        VIEW IMAGE
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in Gallery_Data" :key="item.id">
                <td>
                     <a :href="item.id" target="_blank">{{ item.id }}</a>
                </td>

                <td>
                    {{ item.filename}}
                </td>

                <td>
                    {{ item.width}}
                </td>

                <td>
                    {{ item.height}}
                </td>
                <td>
                    {{ item.hash_value}}
                </td>
                <td>
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
:src="path + item.relative_path" alt="Combined Image">
</v-img>
                
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
        name:"Table_comp",
        data(){
            return {
            Gallery_Data: null,
            path:"http://127.0.0.1:8000/photos/"
          }
        },
        methods:{
            async GetData() {
                let result = await axios.get("http://127.0.0.1:8000/api/Gallery");
                return result.data; // Return the data property from the response object
        }
    },
    async mounted() {
        const data = await this.GetData(); // Correctly await the GetData method
        this.Gallery_Data = data['photos'];
        },
}

    </script>
    
 
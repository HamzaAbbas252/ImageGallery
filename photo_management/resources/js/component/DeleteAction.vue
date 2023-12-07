<template>
    <v-table fixed-header class="d-flex  pa-8 w-100 h-50 " >
        <thead>
            <tr >

                <th class="text-center font-weight-black">
                    id
                </th>
                <th class="text-center font-weight-black">
                    filename
                </th>
                <th class="text-left font-weight-black">
                    width
                </th>
                <th class="text-center font-weight-black">
                    height
                </th>
                <th class="text-center font-weight-black">
                    hash_value
                </th>
                <th class="text-center font-weight-black">
                    VALUES TO DELETE 
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in ALLRepeated_Data" :key="item.id">
                <td class="text-center">
                    {{ item.id}}
                </td>
                <td class="text-center">
                    {{ item.filename}}
                </td>
                <td>
                    {{ item.width}}
                </td >
                <td class="text-center">
                    {{ item.height}}
                </td>
                <td class="text-center">
                    {{ item.hash_value}}
                </td>

                <td class="text-center">
                    <input type="checkbox" :id="item.id" :value ="item.id" v-model="checkedids" >
                </td>

                <!-- <td  class="d-flex ml-12">
                <input type="checkbox" id={{ item.id }} value={{item.id}} v-model="checkedids">
            </td> -->

            </tr>
        </tbody>
    </v-table>

    <v-row class="d-flex" style="background-color: rgb(255, 172, 172);">
        <v-col md="8"></v-col>
        <v-col md="4">
        <v-btn
        class="text-none ms-4 text-white  "
        color="red-darken-4"
        rounded="0"
        variant="flat"
        @click="DeleteData()"
      >
        DELETE
      </v-btn>

      <v-btn
        class="text-none ms-4 text-white  "
        color="grey-darken-4"
        rounded="0"
        variant="flat"
        @click="ClearALLButton()"
      >
        Clear All
      </v-btn>

        <v-btn
        class="text-none ms-4 text-white  "
        color="grey-darken-4"
        rounded="0"
        variant="flat"
        @click="backbutton()"
      >
        Cancel
      </v-btn>
    </v-col>
    
</v-row>
    </template>
    <script>
    import axios from 'axios'

    export default {
        name:"Deletion_table",
        data(){
            return {
             checkedids :[],
             ALLRepeated_Data:null
             

        }
        },
        methods:{
            ClearALLButton()
            {
                this.checkedids=[]
            },
            backbutton(){
                this.$router.push('/action'); 
            },           
            async GetData() {
                let result = await axios.post("http://127.0.0.1:8000/api/AllRepeatedData",{"hash_value":"3d1d0fe2b9bffd00"});
                return result.data; // Return the data property from the response object
            },
            async DeleteData() {
                let result = await axios.post("http://127.0.0.1:8000/api/DeleteRepeatedData",{"PhotoIds":this.checkedids});
                const data = await this.GetData(); // Correctly await the GetData method
                this.ALLRepeated_Data = data['photos'];
            }
    },
    async mounted() {
        const data = await this.GetData(); // Correctly await the GetData method
        this.ALLRepeated_Data = data['photos'];
        },
}

    </script>
    
 
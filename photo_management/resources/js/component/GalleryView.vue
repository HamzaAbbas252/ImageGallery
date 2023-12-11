<template>
<v-row>
    <v-col md="6">
        <v-sheet width="300" class="mx-auto">

            <v-form>

                <v-select v-model="selected_source" :items=FilePath :rules="[v => !!v || 'Item is required']" label="SourcePath" required ></v-select>

                <v-select v-model="selected_destincation" :items=FolderPath :rules="[v => !!v || 'Item is required']" label="Destination" required></v-select>

                <div class="d-flex flex-column">
                    <v-btn color="success" class="mt-4" block @click="COPY()">
                        Copy
                    </v-btn>

                    <v-btn color="warning" class="mt-4" block @click="MOVE()">
                        Move
                    </v-btn>

                    <v-btn color="secondary" class="mt-4" block @click="SYMLINK()">
                        CREATE SYMLINK
                    </v-btn>

                    <v-btn color="blue-grey" class="mt-4" block @click="HARDLINK()">
                        HARDLINK
                    </v-btn>

                </div>
            </v-form>
        </v-sheet>
    </v-col>

    <v-col md="6">
        <v-sheet width="300" class="mx-auto">

            <v-form>

                <v-select v-model="selected_file_to_ViewANDDel" :items=FilePath :rules="[v => !!v || 'Item is required']" label="FILE" required></v-select>

                <div class="d-flex flex-column">


                    <v-dialog
        transition="dialog-top-transition"
        width="auto"
      >
        <template v-slot:activator="{ props }">
          <v-btn
            color="success"
            class="mt-4"
            v-bind="props"
            @click="VIEW()"
          >VIEW</v-btn>
        </template>
        <template v-slot:default="{ isActive }">
          <v-card>
            <v-toolbar
              color="primary"
              title="View"
            ></v-toolbar>

            <v-img
  :width="300"
  aspect-ratio="16/9"
  cover
:src="basepath + photopath" alt="Combined Image">
</v-img>


            <v-card-actions class="justify-end">
              <v-btn
                variant="text"
                @click="isActive.value = false"
              >Close</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>


                    <v-btn color="error" class="mt-4" block @click="DELETE()">
                        Delete
                    </v-btn>

                </div>
            </v-form>
        </v-sheet>
    </v-col>

</v-row>

</template>


<script>
import axios from 'axios';

export default {
    name: "GalleryView",
    data() {
        return {
            FilePath: ["abc"], // Initially, no option is
            FolderPath: ["abc"],
            selected_file_to_ViewANDDel: 'nofile selected',
            photopath:'',
            basepath:'http://127.0.0.1:8000/',
            selected_source: 'Source',
            selected_destincation:'Destination'
        };
    },
    methods: {
        async VIEW() {

           const response3 = await axios.post("http://127.0.0.1:8000/api/Galleryview", {
                 "filename": this.selected_file_to_ViewANDDel
            });
            this.photopath= response3.data.path

        },
        async DELETE() {
            let response4 = await axios.post("http://127.0.0.1:8000/api/GalleryDelete", {
                "filePath":this.selected_file_to_ViewANDDel
            });
            console.log(response4)
        },
        ///////////////////////////////////////////////////
        async COPY() {
            let copyresponse = await axios.post("http://127.0.0.1:8000/api/GalleryCopy", {
                "sourcePath":this.selected_source     ,
                "destinationPath":this.selected_destincation
            });
            console.log(copyresponse)
        },
        async MOVE() {
            let moveresponse = await axios.post("http://127.0.0.1:8000/api/GalleryMove", {
                "sourcePath":this.selected_source     ,
                "destinationPath":this.selected_destincation
            });
            console.log(moveresponse)
        },
        async SYMLINK() {
            let softlinkresponse = await axios.post("http://127.0.0.1:8000/api/GallerySoftlink", {
                "sourcePath":this.selected_source     ,
                "destinationPath":this.selected_destincation
            });
            console.log(softlinkresponse)
        },
        async HARDLINK() {
            let hardlinkresponse = await axios.post("http://127.0.0.1:8000/api/GalleryHardlink", {
                "sourcePath":this.selected_source     ,
                "destinationPath":this.selected_destincation
            });
            console.log(hardlinkresponse)
        },

    },
    async mounted() {
        const response = await axios.get("http://127.0.0.1:8000/api/lsa", {});
        this.FilePath = response.data.photos

        const response2 = await axios.get("http://127.0.0.1:8000/api/lsf", {});
        this.FolderPath = response2.data.directories

    }

}
</script>

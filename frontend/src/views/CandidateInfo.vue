<template>
    <v-container fluid>
      <v-toolbar flat color="white">
        <v-toolbar-title>Candidate Information</v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="900px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-layout>
                      <v-flex xs3>
                        <!-- <v-sheet height="90%" width="100%" color="black"> </v-sheet>
                        <v-btn @click="$refs.fileInput" flat>Select an Image</v-btn> -->
                        <img :src="editedItem.photo" :v-model="editedItem.photo" class="uploading-image" />
                        <input type="file" accept="image/jpeg" @change=uploadImage>
                      </v-flex>
                      <v-flex xs4>
                          <v-text-field v-model="editedItem.first_name"  label="First name"></v-text-field>
                          <v-text-field v-model="editedItem.last_name"  label="Lastname"></v-text-field>
                          <v-dialog
                          ref="dialog"
                          v-model="modal"
                          :return-value.sync="editedItem.date_of_birth"
                          persistent
                          lazy
                          full-width
                          width="290px"
                        >
                          <template v-slot:activator="{ on }">
                            <v-text-field
                              v-model="editedItem.date_of_birth"
                              label="Date of Birth"
                              prepend-icon="event"
                              readonly
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker v-model="date" scrollable>
                            <v-spacer></v-spacer>
                            <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                            <v-btn flat color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
                          </v-date-picker>
                      </v-dialog>
                      </v-flex>
                      <v-flex xs5>
                        <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                        <v-text-field v-model="editedItem.homephone" label="Home Phone"></v-text-field>
                        <v-text-field v-model="editedItem.mobile_number" label="Mobile Phone"></v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
                <v-layout>
                  <v-flex xs12>
                      <v-text-field v-model="editedItem.street" label="Street"></v-text-field>
                      <v-text-field v-model="editedItem.city" label="City"></v-text-field>
                      <v-text-field v-model="editedItem.province" label="State/Province"></v-text-field>
                      <v-text-field v-model="editedItem.postal_code" label="Zip/Postal Code"></v-text-field>
                      <v-text-field v-model="editedItem.home_address" label="Home Address"></v-text-field>
                      <v-select
                      v-model="editedItem.emp_country"
                      :items="countries"
                      label="Country"
                      ></v-select>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="candidateInfo"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.first_name }}</td>
          <td class="text-xs-left">{{ props.item.last_name }}</td>
          <td class="text-xs-left">{{ props.item.email }}</td>
          <td class="text-xs-left">{{ props.item.homephone }}</td>
          <td class="text-xs-left">{{ props.item.mobile_number }}</td>
          <td class="justify-center layout px-0">
            <v-icon
              small
              class="mr-2"
              @click="editItem(props.item)"
            >
              edit
            </v-icon>
            <v-icon
              small
              @click="deleteItem(props.item)"
            >
              delete
            </v-icon>
          </td>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>
      </v-data-table>
  </v-container>
</template>

<script>
  import axios from 'axios';
  export default {
    name: "CandidateInfo",
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'First Name',
          align: 'center',
          sortable: false,
          value: 'firstname'
        },
        { text: 'Last Name', align: 'left', value: 'lastname' },
        { text: 'Email Address', align: 'left', value: 'email' },
        { text: 'Home Phone', align: 'left', value: 'homephone' },
        { text: 'Mobile Phone', align: 'left', value: 'mobilephone' },
        { text: 'Actions', align: 'center', value: 'firstname', sortable: false }
      ],
      countries: ['Nigeria', 'The Rest'],
      modal: false,
      candidateInfo: [],
      editedIndex: -1,
      editedItem: {
        first_name: '',
        last_name: '',
        email: '',
        homephone: '',
        mobile_number: '',
        date_of_birth: '',
        street: '',
        city: '',
        province: '',
        postal_code: '',
        emp_country: '',
        home_address: '',
        photo: '',
      },
      defaultItem: {
        first_name: '',
        last_name: '',
        email: '',
        homephone: '',
        mobile_number: '',
        date_of_birth: new Date().toISOString().substr(0, 10),
        street: '',
        city: '',
        province: '',
        postal_code: '',
        emp_country: '',
        home_address: '',
        photo: '',
      }
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      }
    },

    created () {
      this.initialize()
    },

    methods: {
      uploadImage(e){
        const image = e.target.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = e =>{
        this.editedItem.photo = e.target.result;
        };
      },
      initialize () {
        axios.get('candidates')
        .then((data) => { this.candidateInfo = (data.data.message); })
        .catch((error) => console.log(error))
      },

      editItem (item) {
        this.editedIndex = this.candidateInfo.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.candidateInfo.indexOf(item)
        let id = item.id;
        let cI = this.candidateInfo;
        confirm('Are you sure you want to delete this item?') &&           
        axios.post('candidates/delete', {id}).then((data) => {
            if (data.request.status === 200){
              cI.splice(index, 1)
              console.log(data);
            }else{
              alert("not saved");
            }
        } ).catch((a) => { console.log(a); this.btnLoginClicked = false; });            
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
              let eI = this.editedIndex;
              let cI = this.candidateInfo;
              let edIt = this.editedItem;
              axios.post('candidates/update', edIt).then((data) => {
                if (data.request.status === 200){
                  Object.assign(cI[eI], edIt)
                }else{
                  alert("not saved");
                }
            } ).catch((a) => { alert(a || "unknown from editting error"); this.btnLoginClicked = false; });            
          } else {
              let eI = this.editedIndex;
              let cI = this.candidateInfo;
              let edIt = this.editedItem;
            axios.post('candidates/store', this.editedItem).then((data) => {
                if (data.request.status === 200){
                  cI.unshift(edIt);
                }else{
                  alert("not saved");
                }
            } ).catch((a) => { alert(a.response.data.error || "unknown error"); this.btnLoginClicked = false; });            
          }
          this.close()
      }
    }
  }
</script>

<style>
  .uploading-image{
    width: 100%;
    height: 90%;
  }
</style>

<template>
    <v-container fluid>
      <v-toolbar flat color="white">
        <v-toolbar-title>Client Information</v-toolbar-title>
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
                          <v-flex xs6>
                            <v-text-field v-model="editedItem.director_email" label="Directors Email"></v-text-field>
                            <v-text-field v-model="editedItem.director_firstname"  label="Director's First name"></v-text-field>
                            <v-text-field v-model="editedItem.director_lastname"  label="Director's Lastname"></v-text-field>
                            <v-text-field v-model="editedItem.company_name"  label="Company"></v-text-field>
                            <v-text-field v-model="editedItem.director_phone"  label="Director's Phone"></v-text-field>
                          </v-flex>
                          <v-flex xs6>
                            <v-text-field v-model="editedItem.company_phone_no" label="Business Phone"></v-text-field>
                            <v-text-field v-model="editedItem.company_fax"  label="Fax Number"></v-text-field>
                            <v-text-field v-model="editedItem.company_followup_contact"  label="Follow Up Contact"></v-text-field>
                            <v-text-field v-model="editedItem.company_followup_email"  label="Follow Up Email"></v-text-field>
                            <input type="hidden" :v-model="editedItem.id">
                          </v-flex>
                      </v-layout>
                  </v-flex>
                </v-layout>
                <v-layout>
                  <v-flex xs12>
                      <v-text-field v-model="editedItem.company_province" label="Street"></v-text-field>
                      <v-text-field v-model="editedItem.company_city" label="City"></v-text-field>
                      <v-text-field v-model="editedItem.company_province" label="State/Province"></v-text-field>
                      <v-text-field v-model="editedItem.company_postal_code" label="Zip/Postal Code"></v-text-field>
                      <v-select
                      v-model="editedItem.country"
                      :items="countries"
                      label="Country"
                      ></v-select>
                    <v-textarea
                        v-model="editedItem.company_notes"
                        auto-grow
                        box
                        label="Notes"
                        rows="3"
                    ></v-textarea>
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
          <td>{{ props.item.director_firstname }}</td>
          <td class="text-xs-left">{{ props.item.director_lastname }}</td>
          <td class="text-xs-left">{{ props.item.director_email }}</td>
          <td class="text-xs-left">{{ props.item.company_name }}</td>
          <td class="text-xs-left">{{ props.item.director_phone }}</td>
          <td class="text-xs-left">{{ props.item.company_phone_no }}</td>
          <td class="text-xs-left">{{ props.item.company_fax }}</td>
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
  import axios from "axios";
  export default {
    name: "ClientInfo",
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'Director\'s First Name',
          align: 'center',
          sortable: false,
          value: 'name'
        },
        { text: 'Director\'s Last Name', align: 'left', value: 'director_firstname' },
        { text: 'Director\'s Email Address', align: 'left', value: 'director_email' },
        { text: 'Company', align: 'left', value: 'company' },
        { text: 'Director\'s Mobile Number', align: 'left', value: 'mobilephone' },
        { text: 'Business Phone', align: 'left', value: 'businessphone' },
        { text: 'Fax Number', align: 'center', value: 'faxnumber'},
        { text: 'Actions', align: 'center', sortable: false }
      ],
      countries: ['Nigeria', 'The Rest'],
      modal: false,
      candidateInfo: [],
      date: new Date().toISOString().substr(0, 10),
      editedIndex: -1,
      editedItem: {
        director_firstname: '',
        director_lastname: '',
        director_email: '',
        director_phone: '',
        company_name: '',
        company_address: '',
        company_phone_no: '',
        company_fax: '',
        company_city: '',
        company_province: '',
        company_followup_email: '',
        company_followup_contact: '',
        company_postal_code: '',
        company_notes: '',
        id: ''
      },
      defaultItem: {
        director_firstname: '',
        director_lastname: '',
        director_email: '',
        director_phone: '',
        company_name: '',
        company_address: '',
        company_phone_no: '',
        company_fax: '',
        company_city: '',
        company_province: '',
        company_followup_email: '',
        company_followup_contact: '',
        company_postal_code: '',
        company_notes: '',
        id: ''
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
        axios.get('companies')
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
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
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
            axios.post('companies/update', edIt).then((data) => {
              if (data.request.status === 200){
                Object.assign(cI[eI], edIt)
              }else{
                alert("not saved");
              }
          } ).catch((a) => { alert(a || "unknown from editting error"); this.btnLoginClicked = false; });            
        } else {
            let eI = this.editedIndex;
            let cI = this.candidateInfo;
            let {position_name, position_description} = this.editedItem;
          axios.post('companies/store', this.editedItem).then((data) => {
              if (data.request.status === 200){
                cI.unshift({position_name, position_description});
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

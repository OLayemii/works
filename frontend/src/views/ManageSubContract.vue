<template>
    <v-container fluid>
        <v-toolbar flat color="white">
            <v-toolbar-title>Sub Contracts Information</v-toolbar-title>
            <v-divider class="mx-2" inset vertical></v-divider>
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
                                        <div>
                                            <v-tabs v-model="active" color="cyan" dark slider-color="yellow">
                                                <v-tab ripple>
                                                    General
                                                </v-tab>
                                                <v-tab ripple>
                                                    Pre-Enrollment Info
                                                </v-tab>
                                                <v-tab ripple>
                                                    Post-Enrollment Info
                                                </v-tab>
                                                <v-tab ripple>
                                                    Scanned Documents
                                                </v-tab>
                                                <v-tab-item>
                                                    <v-card flat>
                                                        <v-card-text>
                                                            <v-layout>
                                                                <v-flex xs12>
                                                                    <div class="title">Contract Information</div>
                                                                    <v-select
                                                                    v-model="editedItem.masterContract"
                                                                    :items="masterContracts"
                                                                    label="Master Contract"
                                                                    outline
                                                                    ></v-select>
                                                                </v-flex>
                                                            </v-layout>
                                                        </v-card-text>
                                                    </v-card>
                                                </v-tab-item>
                                                <v-tab-item>
                                                    <v-card flat>
                                                        <v-card-text>World</v-card-text>
                                                    </v-card>
                                                </v-tab-item>
                                            </v-tabs>
                                            <div class="text-xs-center mt-3">
                                                <v-btn @click="next">next tab</v-btn>
                                            </div>
                                        </div>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                            <v-layout>
                                <v-flex xs12>
                                    <v-text-field v-model="editedItem.street" label="Street"></v-text-field>
                                    <v-text-field v-model="editedItem.city" label="City"></v-text-field>
                                    <v-text-field v-model="editedItem.state" label="State/Province"></v-text-field>
                                    <v-text-field v-model="editedItem.zip" label="Zip/Postal Code"></v-text-field>
                                    <v-select v-model="editedItem.country" :items="countries" label="Country"></v-select>
                                    <v-textarea v-model="editedItem.notes" auto-grow box label="Notes" rows="3"></v-textarea>
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
        <v-data-table :headers="headers" :items="candidateInfo" class="elevation-1">
            <template v-slot:items="props">
                <td>{{ props.item.firstname }}</td>
                <td class="text-xs-left">{{ props.item.lastname }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.company }}</td>
                <td class="text-xs-left">{{ props.item.mobilephone }}</td>
                <td class="text-xs-left">{{ props.item.businessphone }}</td>
                <td class="text-xs-left">{{ props.item.faxnumber }}</td>
                <td class="justify-center layout px-0">
                    <v-icon small class="mr-2" @click="editItem(props.item)">
                        edit
                    </v-icon>
                    <v-icon small @click="deleteItem(props.item)">
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
  export default {
    name: "ManageSubContract",
    data: () => ({
      dialog: false,
      active: null,
      text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
      headers: [
        {
          text: 'Director\'s First Name',
          align: 'center',
          sortable: false,
          value: 'name'
        },
        { text: 'Director\'s Last Name', align: 'left', value: 'firstname' },
        { text: 'Director\'s Email Address', align: 'left', value: 'email' },
        { text: 'Company', align: 'left', value: 'company' },
        { text: 'Director\'s Mobile Number', align: 'left', value: 'mobilephone' },
        { text: 'Business Phone', align: 'left', value: 'businessphone' },
        { text: 'Fax Number', align: 'center', value: 'faxnumber'},
        { text: 'Actions', align: 'center', sortable: false }
      ],
      masterContracts: ['Building Hostel', 'Killing Shaun'],
      modal: false,
      candidateInfo: [],
      date: new Date().toISOString().substr(0, 10),
      editedIndex: -1,
      editedItem: {
        firstname: '',
        lastname: '',
        email: '',
        company: '',
        mobilephone: '',
        businessphone: '',
        faxnumber: '',
        city: '',
        state: '',
        zip: '',
        country: '',
        notes: '',
      },
      defaultItem: {
        firstname: '',
        lastname: '',
        email: '',
        homephone: '',
        mobilephone: '',
        dob: '',
        street: '',
        city: '',
        state: '',
        zip: '',
        country: '',
        notes: ''
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
      next () {
        const active = parseInt(this.active)
        this.active = (active < 2 ? active + 1 : 0)
      },
      initialize () {
        this.candidateInfo = [
          {
            firstname: 'OLayemii',
            lastname: 'Garuba',
            email: 'donyemisco@gmail.com',
            homephone: '07033195813',
            mobilephone: '09024561557',
            company: 'Unilever Nigeria',
            mobilephone: '090333224444',
            businessphone: '090322133445',
            faxnumber: '+004940004040'
          }
        ]
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
        console.log(this.editedItem.photo);
        if (this.editedIndex > -1) {
          Object.assign(this.candidateInfo[this.editedIndex], this.editedItem)
        } else {
          this.candidateInfo.push(this.editedItem)
        }
        // this.close()
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

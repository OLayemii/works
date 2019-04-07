<template>
    <v-container fluid>
      <v-toolbar flat color="white">
        <v-toolbar-title>Position Information</v-toolbar-title>
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
                          <v-text-field v-model="editedItem.position_name"  label="Position Name"></v-text-field>
                          <v-text-field v-model="editedItem.position_description"  label="Description"></v-text-field>
                          <input type="hidden" v-model="editedItem.id" />
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
          <td>{{ props.item.position_name }}</td>
          <td class="text-xs-left">{{ props.item.position_description }}</td>
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
    name: "ContractInfo",
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'Name',
          align: 'center',
          sortable: false,
          value: 'position_name'
        },
        { text: 'Description', align: 'left', value: 'position_description', sortable: false },
        { text: 'Actions', align: 'center', value: 'position_name', sortable: false }
      ],
      candidateInfo: [],
      editedIndex: -1,
      editedItem: {
        position_name: '',
        position_description: '',
        id: ''
      },
      defaultItem: {
        position_name: '',
        position_description: '',
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
      initialize () {
        axios.get('positions')
        .then((data) => { this.candidateInfo = this.getJSON(data.data.message); })
        .catch((error) => console.log(error))

      },
      getJSON(data) { 
        return JSON.parse(JSON.stringify(data))
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
        axios.post('positions/delete', {id}).then((data) => {
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
            axios.post('positions/update', edIt).then((data) => {
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
          axios.post('positions/store', this.editedItem).then((data) => {
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
</style>

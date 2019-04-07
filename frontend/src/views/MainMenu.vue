<template>
    <div>
        <v-btn @click="sayHello">Hello</v-btn>
        <v-container fluid id="mainMenu" class="py-0 pt-5 pb-5">
            <MenuItem class="my-3" v-for="(menu, index) in menus" :key="menu.id" :menudata="menu" :meta="menuMetaData[index]"  />
        </v-container>
    </div>
</template>

<script>
import MenuItem from '../components/MenuItem.vue';
import axios from 'axios';
export default {
    name: "MainMenu",
    components: {
        MenuItem
    },
    methods: {
        sayHello() {
            axios.post("/auth/getjobs")
            .then((data) => console.log(data))
        }
    },  
    data: function(){
        return {
            menuMetaData: [
                {
                    name: "Database Functions",
                    color: "teal"
                },
                {
                    name: "Report Functions",
                    color: "red", 
                },
                {
                    name: "Administrator Functions",
                    color: "blue"
                }
            ],
            menus: [
                [
                    {
                        id: 1,
                        name: "Manage Positions",
                        icon: "layers",
                        url: "/managepositions",
                    },
                    {
                        id: 2,
                        name: "Manage Candidates",
                        icon: "person",
                        url: "/candidateinfo",
                    },
                    {
                        id: 3,
                        name: "Manage Clients",
                        icon: "layers",
                        url: "/clientinfo",
                    },
                    {
                        id: 4,
                        name: "Manage Contracts",
                        icon: "receipt",
                        url: "/managecontracts",
                    },
                    {
                        id: 5,
                        name: "Manage Progress",
                        icon: "fast_forward",
                        url: "/fast_forward",
                    }
                ],
                [
                    {
                        id: 1,
                        name: "Candidiates Information Report",
                        icon: "format_align_justify",
                        url: "/candidateinforeport",
                    },
                    {
                        id: 2,
                        name: "Clients Information Report",
                        icon: "group",
                        url: "/clientsinforeport",
                    },
                    {
                        id: 3,
                        name: "Contracts Information Report",
                        icon: "import_contacts",
                        url: "/contractsinforeport",
                    },
                    {
                        id: 4,
                        name: "Contracts Detailed Report I",
                        icon: "looks_one",
                        url: "/contracts1",
                    },
                    {
                        id: 5,
                        name: "Contracts Detailed Report II",
                        icon: "looks_two",
                        url: "/contracts2",
                    }
                ],
                [
                    {
                        id: 1,
                        name: "Register New User",
                        icon: "person_add",
                        url: "/managecandidates",
                    },
                    {
                        id: 2,
                        name: "View/Modify Users",
                        icon: "person",
                        url: "managecandidates",
                    },
                ]
            ]
        }
    }
}
</script>

<style>
    /* #mainMenu .v-icon{
        font-size: 2rem !important;
    } */
</style>

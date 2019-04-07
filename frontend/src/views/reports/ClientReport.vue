<template>
    <v-container fluid>
            <h2>All Candidates</h2>
            <v-data-table
            :headers="headers"
            :items="client"
            class="elevation-1"
            >
                <template v-slot:items="props">
                <td class="text-xs-left">{{ props.item.company }}</td>
                <td class="text-xs-left">{{ props.item.name }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.mobilephone }}</td>
                <td class="text-xs-left">{{ props.item.businessphone }}</td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "ClientReport",
    data: function(){
        return {
            headers: [
                {
                text: 'Company',
                align: 'left',
                sortable: false,
                value: 'company'
                },
                { text: 'Name', value: 'name' },
                { text: 'Email Address', value: 'email' },
                { text: 'Mobile Phone', value: 'mobilephone' },
                { text: 'Business Phone', value: 'businessphone' },
            ],

            client: [
                {
                    company: 'Unilever Nigeria',
                    name: 'OLayemii '+' Garuba',
                    email: 'donyemisco@gmail.com',
                    homephone: '080994943443',
                    mobilephone: '094039304940',
                    businessphone: '094039304940',
                }
            ]
        }
    }
}
</script>

<style>

</style>

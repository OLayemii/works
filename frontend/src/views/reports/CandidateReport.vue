<template>
    <v-container fluid>
            <h2>All Candidates</h2>
            <v-data-table
            :headers="headers"
            :items="candidate"
            class="elevation-1"
            >
                <template v-slot:items="props">
                <td class="text-xs-left">{{ props.item.name }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.homephone }}</td>
                <td class="text-xs-left">{{ props.item.mobilephone }}</td>
                <td class="text-xs-left">{{ props.item.position }}</td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "CandidateReport",
    data: function(){
        return {
            headers: [
                {
                text: 'Name',
                align: 'left',
                sortable: false,
                value: 'name'
                },
                { text: 'Email Address', value: 'email' },
                { text: 'Home Phone', value: 'homephone' },
                { text: 'Mobile Phone', value: 'mobilephone' },
                { text: 'Position', value: 'position' },
            ],

            candidate: [
                {
                    name: 'OLayemii '+' Garuba',
                    email: 'donyemisco@gmail.com',
                    homephone: '080994943443',
                    mobilephone: '094039304940',
                    position: 'General Manager'
                }
            ]
        }
    }
}
</script>

<style>

</style>

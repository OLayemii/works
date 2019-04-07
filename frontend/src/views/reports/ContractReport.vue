<template>
    <v-container fluid>
            <h2>All Contracts</h2>
            <v-data-table
            :headers="headers"
            :items="client"
            class="elevation-1"
            >
                <template v-slot:items="props">
                <td class="text-xs-left">{{ props.item.candidate_name }}</td>
                <td class="text-xs-left">{{ props.item.director_name }}</td>
                <td class="text-xs-left">{{ props.item.position }}</td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "ContractReport",
    data: function(){
        return {
            headers: [
                {
                text: 'Candidate Name',
                align: 'left',
                sortable: false,
                value: 'candidate_name'
                },
                { text: 'Director Name', value: 'director_name' },
                { text: 'Position', value: 'position' },
            ],

            client: [
                {
                    candidate_name: 'OLayemii '+' Garuba',
                    director_name: 'Tina '+' Garuba',
                    position: 'Software Developer',
                }
            ]
        }
    }
}
</script>

<style>

</style>

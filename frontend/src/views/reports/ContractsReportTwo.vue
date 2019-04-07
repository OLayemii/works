<template>
    <v-container fluid>
            <h2>Contracts Progress Detailed Report 2</h2>
            <v-data-table
            :headers="headers"
            :items="client"
            class="elevation-1"
            >
                <template v-slot:items="props">
                <td class="text-xs-left">{{ props.item.candidate_name }}</td>
                <td class="text-xs-left">{{ props.item.director_name }}</td>
                <td class="text-xs-left">{{ props.item.position }}</td>
                <td class="text-xs-left">{{ props.item.first_screening_date }}</td>
                <td class="text-xs-left">{{ props.item.caq_eimt_document_date }}</td>
                <td class="text-xs-left">{{ props.item.criminal_back_date }}</td>
                <td class="text-xs-left">{{ props.item.references_date }}</td>
                <td class="text-xs-left">{{ props.item.invoice2 }}</td>
                <td class="text-xs-left">{{ props.item.second_payment_received }}</td>
                <td class="text-xs-left">{{ props.item.welcome_correspondence_date }}</td>
                <td class="text-xs-left">{{ props.item.french_class_date }}</td>
                <td class="text-xs-left">{{ props.item.provincal_federal_file_date }}</td>
                <td class="text-xs-left">{{ props.item.visa_workpermit_date }}</td>
                <td class="text-xs-left">{{ props.item.ticket_and_insurance_date }}</td>
                <td class="text-xs-left">{{ props.item.travel_induction_date }}</td>
                <td class="text-xs-left">{{ props.item.departure_date }}</td>
                <td class="text-xs-left">{{ props.item.arrival_date }}</td>
                <td class="text-xs-left">{{ props.item.airport_pickup_date }}</td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "ContractReportsTwo",
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
                { text: 'First Screening Date', value: 'first_screening_date' },
                { text: 'CAQ EIMT Document Date', value: 'caq_eimt_document_date' },
                { text: 'Criminal Background Date', value: 'criminal_back_date' },
                { text: 'References Date', value: 'references_date' },
                { text: 'Invoice  2', value: 'invoice2' },
                { text: 'Second Payment Recieved Date', value: 'second_payment_received' },
                { text: 'Welcome Correspondence Date', value: 'welcome_correspondence_date' },
                { text: 'French Class Date', value: 'french_class_date' },
                { text: 'Provincal Federal File Date', value: 'provincal_federal_file_date' },
                { text: 'Visa Workpermit Date', value: 'visa_workpermit_date' },
                { text: 'Ticket and Insurance Date', value: 'ticket_and_insurance_date' },
                { text: 'Travel Induction Date', value: 'travel_induction_date' },
                { text: 'Departure Date', value: 'departure_date' },
                { text: 'Arrival Date', value: 'arrival_date' },
                { text: 'Airport Pickup Date', value: 'airport_pickup_date' },
            ],

            client: [
                {
                    candidate_name: 'OLayemii '+' Garuba',
                    director_name: 'Tina '+' Garuba',
                    position: 'Software Developer',
                    first_screening_date: '1-4-2019',
                    caq_eimt_document_date: '2-4-2020',
                    criminal_back_date: '11-July-2020',
                    references_date: '12-July-2020',
                    invoice2: 'I skipped 13',
                    second_payment_received: '14-July-2020',
                    welcome_correspondence_date: '15-July-2020',
                    french_class_date: '16-July-2020',
                    provincal_federal_file_date: '17-July-2020',
                    visa_workpermit_date: '18-July-2020',
                    ticket_and_insurance_date: '19-July-2020',
                    travel_induction_date: '20-July-2020',
                    departure_date: '21-July-2020',
                    arrival_date: '22-July-2020',
                    airport_pickup_date: '23-July-2020'
                }
            ]
        }
    }
}
</script>

<style>

</style>

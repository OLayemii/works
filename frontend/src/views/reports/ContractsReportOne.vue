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
                <td class="text-xs-left">{{ props.item.invoice1 }}</td>
                <td class="text-xs-left">{{ props.item.resume_review_date }}</td>
                <td class="text-xs-left">{{ props.item.first_interview_date }}</td>
                <td class="text-xs-left">{{ props.item.second_interview_date }}</td>
                <td class="text-xs-left">{{ props.item.medical_exam_date }}</td>
                <td class="text-xs-left">{{ props.item.passport_scan_date }}</td>
                <td class="text-xs-left">{{ props.item.employment_doc_date }}</td>
                <td class="text-xs-left">{{ props.item.first_payment_date }}</td>
                <td class="text-xs-left">{{ props.item.profile_req_date }}</td>
                <td class="text-xs-left">{{ props.item.immigration_form_date }}</td>
                <td class="text-xs-left">{{ props.item.offer_posting_date }}</td>
                <td class="text-xs-left">{{ props.item.offer_approval }}</td>
                <td class="text-xs-left">{{ props.item.agency_posting }}</td>
                <td class="text-xs-left">{{ props.item.agency_reception }}</td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "ContractReportsOne",
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
                { text: 'Invoice Number 1', value: 'invoice1' },
                { text: 'Resume Review Date', value: 'resume_review_date' },
                { text: 'First Interview Date', value: 'first_interview_date' },
                { text: 'Second Interview Date', value: 'second_interview_date' },
                { text: 'Medical Exam Date', value: 'medical_exam_date' },
                { text: 'Passport Scan Date', value: 'passport_scan_date' },
                { text: 'Employment Doc Date', value: 'employment_doc_date' },
                { text: 'First Payment Date', value: 'first_payment_date' },
                { text: 'Profile Request Sent Date', value: 'profile_req_date' },
                { text: 'Immigration Question Form Date', value: 'immigration_form_date' },
                { text: 'Offer Posting Date', value: 'offer_posting_date' },
                { text: 'Offer Approval', value: 'offer_approval' },
                { text: 'Agency Posting Date', value: 'agency_posting' },
                { text: 'Agency Reception Date', value: 'agency_reception' },
            ],

            client: [
                {
                    candidate_name: 'OLayemii '+' Garuba',
                    director_name: 'Tina '+' Garuba',
                    position: 'Software Developer',
                    invoice1: 'Invoice#1',
                    resume_review_date: '10-July-2020',
                    first_interview_date: '11-July-2020',
                    second_interview_date: '12-July-2020',
                    medical_exam_date: '13-July-2020',
                    passport_scan_date: '14-July-2020',
                    employment_doc_date: '15-July-2020',
                    first_payment_date: '16-July-2020',
                    profile_req_date: '17-July-2020',
                    immigration_form_date: '18-July-2020',
                    offer_posting_date: '19-July-2020',
                    offer_approval: '20-July-2020',
                    agency_posting: '21-July-2020',
                    agency_reception: '22-July-2020'
                }
            ]
        }
    }
}
</script>

<style>

</style>

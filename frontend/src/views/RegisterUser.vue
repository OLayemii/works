<template>
    <v-container>
        <v-layout>
            <v-flex md8 sm12>
                <v-form
                    class="text-xs-left"
                    ref="regform"
                >
                    <v-container fluid grid-list-xs class="px-0 pb-0">
                        <v-layout>
                            <v-flex xs6>
                                <v-text-field
                                v-model="user.firstname"
                                label="First Name"
                                outline
                                v-validate="'required|max:50'"
                                data-vv-name="firstname"
                                data-vv-validate-on="blur"
                                :error-messages="errors.collect('firstname')" 
                                required
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs6>
                                <v-text-field
                                v-model="user.lastname"
                                label="Last Name"
                                v-validate="'required|max:50'"
                                data-vv-name="lastname"
                                data-vv-validate-on="blur"
                                :error-messages="errors.collect('lastname')" 
                                required
                                outline
                                ></v-text-field> 
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-text-field
                    v-model="user.username"
                    :counter="50"
                    label="Username"
                    v-validate="'required|max:50'"
                    data-vv-name="username"
                    data-vv-validate-on="blur"
                    :error-messages="errors.collect('username')" 
                    required
                    outline
                    ></v-text-field>

                    <v-text-field
                    v-model="user.password"
                    label="Password"
                    type="password"
                    v-validate="'required|min:8'"
                    data-vv-name="password"
                    data-vv-validate-on="blur"
                    :error-messages="errors.collect('password')" 
                    required
                    outline
                    ></v-text-field>


                    <v-text-field
                    v-model="user.email"
                    label="Email Address"
                    type="email"
                    v-validate="'required|email'"
                    data-vv-name="email"
                    data-vv-validate-on="blur"
                    :error-messages="errors.collect('email')" 
                    required
                    outline
                    ></v-text-field>

                    <v-text-field
                    v-model="user.mobileno"
                    label="Mobile Number"
                    type="text"
                    v-validate="'required'"
                    data-vv-name="mobileno"
                    data-vv-validate-on="blur"
                    :error-messages="errors.collect('mobileno')" 
                    required
                    outline
                    ></v-text-field>

                    <v-select
                    v-model="user.selectedType"
                    :items="accountTypes"
                    label="Account Type"
                    v-validate="'required'"
                    data-vv-name="accountType"
                    data-vv-validate-on="blur"
                    :error-messages="errors.collect('accountType')" 
                    outline
                    ></v-select>
                    <v-btn color="#1869e2" :loading="btnLoginClicked" @click="createUser" dark>CREATE USER</v-btn>
                </v-form>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    name: "RegisterUser",
    data: function(){
        return {
            accountTypes: ['Administrator', 'Staff', 'Reporter'],
            btnLoginClicked: false,
            user: {
                username: '',
                password: "password",
                firstname: '',
                lastname: '',
                mobileno: '',
                email: '',
                selectedType: ''
            },
        }
    },
    methods: {
        createUser(){
            let that = this;
            this.$validator.validate().then(function(result){
                if(!!result){
                    that.btnLoginClicked = true;
                }
            })
        }
    },
}
</script>

<style>

</style>

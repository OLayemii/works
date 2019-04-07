<template class="fill-height">
    <v-container class="column justify-center fill-height" >
        <span class="display-1 mb-4">Login to Employmentor</span>
        <v-form
            class="text-xs-left"
            ref="form"
        >
            <v-text-field
            v-model="user.email"
            :counter="50"
            label="Email"
            v-validate="'required'"
            data-vv-name="email"
            data-vv-validate-on="blur"
            :error-messages="errors.collect('email')" 
            required
            outline
            ></v-text-field>

            <v-text-field
            v-model="user.password"
            label="Password"
            type="password"
            v-validate="'required'"
            data-vv-name="password"
            data-vv-validate-on="blur"
            :error-messages="errors.collect('password')" 
            required
            outline
            ></v-text-field>
            <v-btn class="mx-0 px-0" color="#1869e2" :loading="btnLoginClicked" @click="validate" dark>SIGN IN</v-btn>
            <div>
                <v-btn href="" flat class="mx-0 px-0">Forgot Password?</v-btn>
            </div>
        </v-form>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    name: "LoginCard",
    data: function(){
        return {
            btnLoginClicked: false,
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        validate(){
            let that = this;
            this.$validator.validate().then((result) => {
                if(!!result){
                    that.btnLoginClicked = true;
                    this.login(this.user);
                }
            })
        },
        login(details) {
            axios.post('auth/login', details).then((data) => {
                if (data.request.status === 200){
                    let token = data.data.token;
                    localStorage.setItem('employmentor_token', token);
                    this.$router.push('main');
                }else{
                    this.data.btnLoginClicked = false;
                }
            } ).catch((a) => { alert(a.response.data.error || "unknown error"); this.btnLoginClicked = false; });            
        }
    },
}
</script>

<style scoped>
    form {
        width: 100%;
    }

    .column {
        flex-direction: column;
    }
</style>

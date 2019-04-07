<template>
    <div class="fill-height">
       <v-container fluid class="pa-0 fill-height">
           <v-layout class="fill-height">
               <v-flex class="fill-height" md7 id="loginLeft">
                   <div class="hero-text">
                       <div class="display-2 hero-main-text white--text text-uppercase">Employmentor</div>
                       <span class="title white--text">A sub text here</span>
                   </div>
               </v-flex>
               <v-flex md5>
                    <LoginCard />
               </v-flex>
           </v-layout>
       </v-container>
    </div>
</template>

<script>
import LoginCard from "../components/LoginCard.vue";
export default {
    name: "Login",
    components:{
        LoginCard
    } 
}
</script>

<style scoped>
    .hero-text{
        position: absolute;
        bottom: 45%;
        text-align: center;
        width: 100%;
    }

    .hero-main-text {
        background: rgba(0,0,0,0.7);
        padding: 7px 0;
    }
</style>

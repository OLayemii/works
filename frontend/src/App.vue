<template>
  <v-app class="fill-height">
    <div id="app" class="fill-height">
      <!-- <TheHeader /> -->
      <transition :name="transitionName">
        <router-view></router-view>
      </transition>
    </div>
  </v-app>
</template>

<script>
import Login from './views/Login.vue';
import MainMenu from './views/MainMenu.vue';
import RegisterUser from './views/RegisterUser.vue';
import TheHeader from './components/TheHeader.vue';
import CandidateInfo from './views/CandidateInfo.vue';
import ClientInfo from './views/ClientInfo.vue';
import ContractInfo from './views/ContractInfo.vue';
import ManagePositions from './views/ManagePositions.vue';
import ManageSubContract from './views/ManageSubContract.vue';
import CandidateReport from './views/reports/CandidateReport.vue';
import ClientReport from './views/reports/ClientReport.vue';
import ContractReport from './views/reports/ContractReport.vue';
import ContractsReportOne from './views/reports/ContractsReportOne.vue';
import ContractsReportTwo from './views/reports/ContractsReportTwo.vue';
export default {
  name: 'app',
  components: {
    Login,
    MainMenu,
    TheHeader,
    RegisterUser,
    CandidateInfo,
    ClientInfo,
    ManagePositions,
    CandidateReport,
    ClientReport,
    ManageSubContract,
    ContractsReportOne,
    ContractsReportTwo
  },
  data(){
    return {
      transitionName: 'slide-left'
    }
  },
  beforeRouteUpdate (to, from, next) {
    const toDepth = to.path.split('/').length
    const fromDepth = from.path.split('/').length
    this.transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left'
    next()
  },
}
</script>

<style>
html, body{
  height: auto;
  min-height: 100vh;
  padding: 0;
  margin: 0;
}
body{
  border: 5px solid rgb(24, 105, 226);
  box-sizing: border-box;

}
#app {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  min-height: calc(100vh - 10px);
}
#loginLeft{
    background-image: url('./assets/img/bg.jpg');
    background-size: cover;
    position: relative;
}
.application--wrap{
  min-height: 100% !important;
}

.v-text-field--outline .v-input__control>.v-input__slot{
    border: 1px solid rgba(0,0,0,.54) !important;
}

.container {
  box-sizing: border-box;
}

.v-icon.outlined {
    border: 1px solid currentColor;
    border-radius:50%;
    height: 56px;
    width: 56px;
}

.link-menu:hover {
    cursor: pointer;
}
</style>

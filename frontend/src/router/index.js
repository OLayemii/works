import Login from '../views/Login.vue';
import MainMenu from '../views/MainMenu.vue';
import RegisterUser from '../views/RegisterUser.vue';
import TheHeader from '../components/TheHeader.vue';
import CandidateInfo from '../views/CandidateInfo.vue';
import ClientInfo from '../views/ClientInfo.vue';
import ContractInfo from '../views/ContractInfo.vue';
import ManagePositions from '../views/ManagePositions.vue';
import ManageSubContract from '../views/ManageSubContract.vue';
import CandidateReport from '../views/reports/CandidateReport.vue';
import ClientReport from '../views/reports/ClientReport.vue';
import ContractReport from '../views/reports/ContractReport.vue';
import ContractsReportOne from '../views/reports/ContractsReportOne.vue';
import ContractsReportTwo from '../views/reports/ContractsReportTwo.vue';


const routerParams = {
    mode: 'history',
    base: __dirname,
    routes: [
      { path: '/', component: Login },
      { path: '/main', component: MainMenu },
      { path: '/candidateinfo', component: CandidateInfo },
      { path: '/managepositions', component: ManagePositions },
      { path: '/clientinforeport', component: ClientReport },
      { path: '/candidateinforeport', component: CandidateReport },
      { path: '/contractsinforeport', component: ContractInfo },
      { path: '/contracts1', component: ContractsReportOne },
      { path: '/contracts2', component: ContractsReportTwo },
      { path: '/managecandidates', component: RegisterUser },
      { path: '/clientinfo', component: ClientInfo }
    ]
  };

  export default routerParams;
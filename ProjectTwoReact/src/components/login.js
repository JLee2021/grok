import template from "./login.html?raw";
import { router } from "../main";
import { LoginCtrl } from "../controller/login";
import { setupVesselList } from "./vessel-list";
import { watch, ref } from "../app-lib";
// import { setupTripList } from './trip-list'

/*
  User ID, Password, Show password, Forgot password
  - email, password-sign-in, show-pass, forgot-pass
*/
// const ctrl = new LoginCtrl()
// const login = ctrl.login()
const login = ref({});

// Setup: Setup a compnent, Load it to the provided el.
async function setupLogin(props = { }) {

  return {
    template,
    onAfter: (el) => {
      watch(login, (n, o) => setupLogin(props), { id: 'login' });

      // Show/Hide failed auth.  ToDo: The Show part.
      document.getElementById("auth_fail_div").style.visibility = "hidden";

      // Force data-navigo update; #submit-login is not updated;
      router.updatePageLinks()
    }
  }
}


export { setupLogin };

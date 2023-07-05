import template from "./login.html?raw";
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
async function setupLogin(el, { $prop = "default" } = { $prop: "default" }) {
  console.info("Do something with passed in property: $prop");

  // example: get proxy reference
  // const login = await (new LoginCtrl()).getStore().getRef()

  // Update Component
  async function update(el) {
    console.info("Updating Login List");
    el.innerHTML = template;

    // Show/Hide failed auth.  ToDo: The Show part.
    document.getElementById("auth_fail_div").style.visibility = "hidden";

    // Add Actions
    // el.querySelector('#frag').innerHTML = $frag(login.value || [])
    el.querySelector("#submit-login").addEventListener("click", toVesselList);
  }

  watch(login, (n, o) => update(el));
  update(el);
}

// Fragments: functions that return small sections of HTML.
// function $frag(items) {
//   return `
//     <di>
//       ${items.map(item => `<li>${item.name} - ${item.id}</li>`).join('')}
//     </di>
//   `
// }

// Actions: navigation, updating the store, none template stuff, etc.
function toVesselList(el) {
  el.preventDefault();
  setupVesselList(document.querySelector("#main"));
}

export { setupLogin };

// import '../assets/style.css'
import { setupLogin } from "./components/login";
import { setupVesselList } from "./components/vessel-list";
import { setupHaulStart } from "./components/haul-start";
import { setupAppCrumbs } from "./components/app-crumbs";
// import { setupAppNav } from "./components/app-nav";

// Setup the First component inside the #app element.
document.querySelector("#app").innerHTML = /*html*/ `
  <div>
    <div id="app-crumbs"></div>

    <!-- We are using bread crumbs for main navigation.
    <div id="app-nav"></div>
    -->

    <main class="usa-layout-docs__main desktop:grid-col-9 usa-prose usa-layout-docs" id="main-content">
  </div>
`;

document.querySelector('#basic-nav-section-two').addEventListener('click', toVesselList)
document.querySelector('#main-nav-login').addEventListener('click', toLogout)


function toVesselList(e) {
  e.preventDefault()
  setupVesselList(document.querySelector("#main-content"))
}
function toLogout(e) {
  e.preventDefault()
  setupLogin(document.querySelector("#main-content"))
}


setupLogin(document.querySelector("#main-content"));
// setupAppNav(document.querySelector("#app-nav"));

// Handle Navigation Links
// document.querySelector("#nav-vessel").addEventListener("click", (e) => {
//   e.preventDefault();
//   setupVesselList(document.querySelector("#main-content"));
//   return;
// });

// document.querySelector("#nav-haulstart").addEventListener("click", (e) => {
//   e.preventDefault();
//   setupHaulStart(document.querySelector("#main-content"));
//   return;
// });

// setupCatchAdd(document.querySelector('#test'))
// setupVesselList(document.querySelector('#main'))
// setupCounter(document.querySelector('#counter'))

// import '../assets/style.css'
import { setupLogin } from './components/login';
import { setupVesselList } from './components/vessel-list'
import { setupAppCrumbs } from './components/app-crumbs';
import { setupAppNav } from './components/app-nav';

// Setup the First component inside the #app element.
document.querySelector('#app').innerHTML = /*html*/`
  <div>
    <div id="app-crumbs"></div>

    <div id="app-nav"></div>

		<div id="main"></div>

    <main class="usa-layout-docs__main desktop:grid-col-9 usa-prose usa-layout-docs" id="main-content">
  </div>
`

setupLogin(document.querySelector('#main'))
setupAppCrumbs(document.querySelector('#app-crumbs'))
setupAppNav(document.querySelector('#app-nav'))

// Handle Navigation Links
document.querySelector('#nav-vessel').addEventListener('click', (e) => {
	e.preventDefault();
	setupVesselList(document.querySelector('#main-content'))
	return
})

// setupCatchAdd(document.querySelector('#test'))
// setupVesselList(document.querySelector('#main'))

// setupCounter(document.querySelector('#counter'))

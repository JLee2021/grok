// import '../assets/style.css'

import { setupVesselList } from './vessel-list'

// Handle Navigation Links
document.querySelector('#nav-vessel').addEventListener('click', (e) => {
	e.preventDefault();
	setupVesselList(document.querySelector('#main'))
	return
})

// Setup the First component inside the #app element.
document.querySelector('#app').innerHTML = `
  <div>

		<div id="main">
		</div>

    <!--
		<div class="card">
      <button id="counter" type="button"></button>
    </div>

    <div class="card" id="vesselList">
    </div>

    <p class="read-the-docs">
      Click on the Vite logo to learn more
    </p>
		-->
  </div>
`

// setupCounter(document.querySelector('#counter'))


/*Add Trip
Btn: Add New Trip;
List: Trip -> haul-list.js
*/
import template from './trip-list.html?raw'
import { TripCtrl } from "../controller/trip"
import { tripApi } from "../service/api"
import { watch } from "../app-lib"

import { setupHaulList } from './haul-list'
import { setupTripStart } from './trip-start'

tripApi.get()
const ctrl = new TripCtrl()

// Setup
async function setupTripList(el, { vpNo = null } = { vpNo: null }) {
  const trips = await ctrl.getStore().getRef()
  ctrl.getStore().update(vpNo)

  // Update Component
  async function update(el) {
    console.info('Updateing Trip List: vessel - %o', vpNo)
    el.innerHTML = template

    // Add Actions
    console.log('trips: %o', trips.value)
    el.querySelector('#trip-list').innerHTML = listTrips(trips.value || [])
    el.querySelector('#start-trip').addEventListener('click', () => toTripStart(vpNo))
  }

  watch(trips, (n, o) => update(el))
  update(el)
}



// Fragments
function listTrips(items) {
  return `
    <di>
      ${items.map(item => `<li>${item.obsId} - ${item.id}</li>`).join('')}
    </di>
  `
}

// Actions
function toHaulList() {
  setupHaulList(document.querySelector('#main'))
}
function toTripStart(vpNo) {
  setupTripStart(document.querySelector('#main'), { vpNo })
}


export {
  setupTripList
}

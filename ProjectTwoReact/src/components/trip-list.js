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
import { setupAppCrumbs } from './app-crumbs'

const ctrl = new TripCtrl()

// Setup
async function setupTripList(el, { vpNo = null } = { vpNo: null }) {
  console.log('Setup TripList: %o', vpNo)
  // async function (el, { vpNo = null, msg = null } = { vpNo: null, msg: null } ) {
  setupAppCrumbs(null, { vpNo, msg: 'Trips' })

  const store = ctrl.getStore(vpNo)

  // Update Component
  async function update() {
    const trips = await store.getMany()
    el.innerHTML = template

    // Add Actions
    el.querySelector('#trip-list').innerHTML = listTrips(trips || [])
    el.querySelector('#trip-list').addEventListener('click', (e) => toHaulList(e))
    el.querySelector('#start-trip').addEventListener('click', () => toTripStart(vpNo))
  }

  const storeRef = await store.getRef()
  watch(storeRef, (n, o) => update(), { id: 'tripList'})
  update()
}


// Fragments
function listTrips(items) {
  console.log('trips: %o', items)
  return items.map(item => `
    <tr>
      <th scope="row" data-sort-value="3">
        <button
          class="usa-button usa-button--accent-cool"
          data-id="${item.id}"
        >
          ${item.id}
        </button>
      </th>
      <td>${item.obsId}</td>
    </tr>`).join('')
}

// Actions
function toHaulList(e) {
  e.preventDefault()
  const tripId = e.target.dataset.id
  setupHaulList(document.querySelector('#main-content'), { tripId })
}
function toTripStart(vpNo) {
  setupTripStart(document.querySelector('#main-content'), { vpNo })
}


export {
  setupTripList
}

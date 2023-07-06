import template from './trip-start.html?raw'
import { TripCtrl } from '../controller/trip'
import { watch } from '../app-lib'

import { setupTripList } from './trip-list'

/*
  Start Trip
  Inputs: Observer ID, Trip Number;
  - obs-id, trip-num
  Btn: Start Trip;
  - start-trip
*/

const ctrl = new TripCtrl()

// Setup
async function setupTripStart(el, {vpNo = null} = {vpNo: null}) {
  // const hauls = await ctrl.getStore().getRef()

  // Update Component
  async function update(el) {
    console.info('Updateing Start Trip: vpNo - %o', vpNo)
    el.innerHTML = template
    document.querySelector('#trip-num').value = `${vpNo}-`

    // Actions
    el.querySelector('#start-trip').addEventListener('click', (e) => startTrip(e, vpNo))
  }

  // watch(hauls, (n, o) => update(el))
  update(el)
}

// Fragments

// Actions
async function startTrip(e, vpNo) {
  e.preventDefault()

  const obsId = document.querySelector('#obs-id').value
  const tripNum = document.querySelector('#trip-num').value

  await ctrl.getStore().addOne({ vpNo, obsId, id: tripNum })
  setupTripList(document.querySelector('#main-content'), { vpNo })
}

export {
  setupTripStart
}

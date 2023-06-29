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
  const hauls = await ctrl.getStore().getRef()

  // Update Component
  async function update(el) {
    console.info('Updateing Start Trip: vpNo - %o', vpNo)
    el.innerHTML = template

    // Actions
    el.querySelector('#start-trip').addEventListener('click', () => startTrip(vpNo))
  }

  watch(hauls, (n, o) => update(el))
  update(el)
}

// Fragments

// Actions
async function startTrip(vpNo) {
  const obsId = document.querySelector('#obs-id').value
  const tripNum = document.querySelector('#trip-num').value

  await ctrl.getStore().addOne({ vpNo, obsId, id: tripNum })
  // .then(() => {
  setupTripList(document.querySelector('#main'), { vpNo })
  // })
}

export {
  setupTripStart
}

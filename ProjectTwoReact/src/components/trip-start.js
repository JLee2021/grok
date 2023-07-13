import template from './trip-start.html?raw'
import { TripCtrl } from '../controller/trip'
import { watch } from '../app-lib'

import { setupTripList } from './trip-list'
import { router } from '../main'

/*
  Start Trip
  Inputs: Observer ID, Trip Number;
  - obs-id, trip-num
  Btn: Start Trip;
  - start-trip
*/

const ctrl = new TripCtrl()

async function setupTripStart(props = {vpNo: null}) {
  const vpNo = props.vpNo
  return {
    template,
    onAfter: (el) => {
      document.querySelector('#trip-num').value = `${vpNo}-`
      el.querySelector('#start-trip').addEventListener('click', (e) => startTrip(e, vpNo))
      // watch(hauls, (n, o) => update(el))
    }
  }

}

// Add a trip navigtate back to trip list.
async function startTrip(e, vpNo) {
  e.preventDefault()

  const obsId = document.querySelector('#obs-id').value
  const tripNum = document.querySelector('#trip-num').value

  await ctrl.getStore().addOne({ vpNo, obsId, id: tripNum })

  console.log('naving to trips: %o', vpNo)
  router.navigate(`/trips/${vpNo}`)
}

export {
  setupTripStart
}

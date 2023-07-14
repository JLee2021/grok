import template from './trip-end.html?raw'
import { TripCtrl } from '../controller/trip'
import { router } from '../main'

/*
  Start Trip
  Inputs: Observer ID, Trip Number;
  - obs-id, trip-num
  Btn: Start Trip;
  - end-trip
*/

const ctrl = new TripCtrl()

async function setupTripEnd(props = {tripId: null, vpNo: null}) {
  const vpNo = props.vpNo
  const tripId = props.tripId
  const store = ctrl.getStore(vpNo)
  console.log('trip - vpNo: %o, %o', tripId, vpNo)
  const trip = await store.getOne(tripId, vpNo)
  console.log('Got a trip: %o', trip)

  return {
    template,
    onAfter: (el) => {
      document.querySelector('#trip-num').value = tripId
      document.querySelector('#obs-id').value = trip.obsId || 'Unk'
      el.querySelector('#end-trip').addEventListener('click', (e) => endTrip(e, trip))
      // watch(hauls, (n, o) => update(el))
    }
  }

}


// Add a trip navigtate back to trip list.
async function endTrip(e, trip) {
  e.preventDefault()

  const obsId = document.querySelector('#obs-id').value
  const tripNum = document.querySelector('#trip-num').value

  // Notice: This is similar to how an edit/update will occur.
  // Update the trip.
  await ctrl.getStore().addOne({
    vpNo: trip.vpNo,
    obsId: trip.obsId,
    id: trip.id,
    dateEnd: Date.now()
  })

  console.log('naving to trips: %o', trip.vpNo)
  router.navigate(`/trips/${trip.vpNo}`)
}

export {
  setupTripEnd
}

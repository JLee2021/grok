// import template from './trip-end.html?raw'
import { render } from '../app-lib'
import { TripCtrl } from '../controller/trip'
import { router } from '../main'
import { setupAppCrumbs } from './app-crumbs'

const ctrl = new TripCtrl()

async function setupTripEnd(props = {id: null, vpNo: null}) {
  const vpNo = props.vpNo
  const tripId = props.id
  const store = ctrl.getStore(vpNo)
  const trip = await store.getOne(tripId, vpNo)

  render(setupAppCrumbs({ vpNo, tripId } ), { id: false })

  /*
    Start Trip
    Inputs: Observer ID, Trip Number;
    - obs-id, trip-num
    Btn: Start Trip;
    - end-trip
  */
  return {
    template: /*html*/ `
<div>
  <form class="usa-form" method="POST" action="">
    <fieldset class="usa-fieldset">
      <legend class="usa-legend usa-legend--large">End Trip</legend>

      <label class="usa-label" for="obs-id">Observer ID</label>
      <input class="usa-input" id="obs-id"
        title="Observer ID"
        name="obs-id"
        value="${trip?.obsId || 'null'}"
      ></input>

      <label class="usa-label" for="trip-num">Trip Number</label>
      <input class="usa-input" id="trip-num"
        title="Disposition Code"
        name="trip-num"
        value="${tripId}"
      ></input>

      <input id="end-trip" class="usa-button" type="submit" name="end-trip" value="End Trip" />
    </fieldset>
  </form>
</div>
    `,
    onAfter: (el) => {
      el.querySelector('#end-trip').addEventListener('click', (e) => endTrip(e, trip))
    }
  }

}


// Add a trip navigtate back to trip list.
async function endTrip(e, trip) {
  e.preventDefault()

  // Notice: This is similar to how an edit/update will occur.
  // Update the trip.
  await ctrl.getStore().addOne({
    vpNo: trip.vpNo,
    obsId: trip.obsId,
    id: trip.id,
    dateEnd: Date.now()
  })

  router.navigate(`/trip/${trip.id}?vpNo=${trip.vpNo}`)
}

export {
  setupTripEnd
}

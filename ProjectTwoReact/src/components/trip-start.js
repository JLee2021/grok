// import template from './trip-start.html?raw'
import { TripCtrl } from '../controller/trip'
import { router } from '../main'

const ctrl = new TripCtrl()

async function setupTripStart(props = {vpNo: null}) {
  const vpNo = props.vpNo
  return {
    template: /*HTML*/`
<!--
  Start Trip
  Inputs: Observer ID
    - obs-id
  Btn: Start Trip;
    - start-trip
-->

<div>
  <form class="usa-form" id="grok_form_login" method="POST" action="#">
    <fieldset class="usa-fieldset">
      <legend class="usa-legend usa-legend--large">Start Trip</legend>

      <label class="usa-label" for="obs-id">Observer ID</label>
      <input class="usa-input" id="obs-id" title="Observer ID" name="obs-id" />

      <input id="start-trip" class="usa-button" type="submit" name="start-trip" value="Start Trip" />
    </fieldset>
  </form>
</div>
    `,
    onAfter: (el) => {
      el.querySelector('#start-trip').addEventListener('click', (e) => startTrip(e, vpNo))
    }
  }

}

// Add a trip navigtate back to trip list.
async function startTrip(e, vpNo) {
  e.preventDefault()
  const obsId = document.querySelector('#obs-id').value
  const store = ctrl.getStore(vpNo)
  const trip = await store.addOne({ vpNo, obsId })
  console.log('Trip: %o', trip)
  router.navigate(`/trip/${trip.id}?vpNo=${vpNo}`)
}

export {
  setupTripStart
}

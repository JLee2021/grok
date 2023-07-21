/*
  Trip Detail
*/
// import template from "./trip-detail.html?raw";
import { TripCtrl } from "../controller/trip";
import { render } from "../app-lib";

import { setupAppCrumbs } from "./app-crumbs";

// Setup
const ctrl = new TripCtrl()
async function setupTripDetail(props = { id: null, vpNo: null }) {
  const tripId = props.id
  const vpNo = props.vpNo
  render(setupAppCrumbs({ vpNo, tripId }), { id: false })
  const store = ctrl.getStore(vpNo)
  const trip = await store.getOne(tripId, vpNo)

  return {
    template:  /*HTML*/ `
<!-- Update an embedded template. -->
<div>
  <div class="usa-card__container">
    <div class="usa-card__header">
      <h2 class="usa-card__heading">Trip Detail</h2>
    </div>

    <div class="usa-card__media">
    </div>

    <div class="usa-card__body">
      <div>
        <label for="trip-name" class="usa-label">Trip ID</label>
        <input id="trip-name" class="usa-input" value="${trip.id}"></input>
      </div>

      <div>
        <label for="trip-id" class="usa-label">Observer ID</label>
        <input id="trip-id" class="usa-input" value="${trip?.obsId}"></input>
      </div>

      <div>
        <label for="trip-id" class="usa-label">Date End</label>
        <input id="trip-id" class="usa-input" value="${trip?.dateEnd}"></input>
      </div>
    </div>

    <div class="usa-card__footer">
      <a href="/trip/${trip.id}/end?vpNo=${trip.vpNo}"
        class="usa-button"
        data-navigo>End</a>
      <!-- ToDo: Add Action; Save changes; Reload or Redirect.
        <a href="#" class="usa-button">Update</a>
      -->
      <a href="/haul?vpNo=${trip.vpNo}&tripId=${trip.id}"
        class="usa-button"
        data-navigo>Hauls</a>
      <button href="/catch?vpNo=${trip.vpNo}&tripId=${trip.id}"
        class="usa-button"
        data-navigo
        disabled>Catches</button>
    </div>
  </div>
</div>
`
  }
}

export { setupTripDetail };

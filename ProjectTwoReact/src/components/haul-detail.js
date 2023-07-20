import { HaulCtrl } from "../controller/haul";
import { render } from "../app-lib";

import { setupAppCrumbs } from "./app-crumbs";
import { HaulStore } from "../store/haul";

// Setup
const ctrl = new HaulCtrl()
async function setupHaulDetail(props = { id: null, vpNo: null, tripId: null }) {
  const haulId = props.id
  const vpNo = props.vpNo
  const tripId = props.tripId

  render(setupAppCrumbs({ vpNo, tripId, msg: 'Haul' }), { id: false })

  const store = new HaulStore({ vpNo, tripId })
  const haul = await store.getOne(haulId)

  console.log('Haul: %o', haul)

  return {
    template:  /*HTML*/ `
<!-- Update an embedded template. -->
<div>
  <div class="usa-card__container">
    <div class="usa-card__header">
      <h2 class="usa-card__heading">Haul Detail</h2>
    </div>

    <div class="usa-card__media">
    </div>

    <div class="usa-card__body">
      <div>
        <label for="haul-name" class="usa-label">Haul ID</label>
        <input id="haul-name" class="usa-input" value="${haul.id}"></input>
      </div>

      <div>
        <label for="haul-id" class="usa-label">GPS Start</label>
        <input id="haul-id" class="usa-input" value="${haul?.startGps}"></input>
      </div>

      <div>
        <label for="haul-id" class="usa-label">Start Date</label>
        <input id="haul-id" class="usa-input" value="${haul?.startDate}"></input>
      </div>

      <div>
        <label for="haul-id" class="usa-label">End Date</label>
        <input id="haul-id" class="usa-input" value="${haul?.endDate}"></input>
      </div>
    </div>

    <div class="usa-card__footer">
      <a href="/haul/${haul.id}/end?vpNo=${haul.vpNo}&tripId=${haul.tripId}"
        class="usa-button"
        data-navigo>End</a>
      <!-- ToDo: Add Action; Save changes; Reload or Redirect.
        <a href="#" class="usa-button">Update</a>
      -->
      <a href="/catch?vpNo=${haul.vpNo}&tripId=${haul.tripId}&haulId=${haul.id}"
        class="usa-button"
        data-navigo>Catches</a>
    </div>
  </div>
</div>
`
  }
}

export { setupHaulDetail };

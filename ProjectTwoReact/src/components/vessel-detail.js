/*
  Vessel Detail
*/
// import template from "./vessel-detail.html?raw";
import { VesselCtrl } from "../controller/vessel";
import { render } from "../app-lib";

import { setupAppCrumbs } from "./app-crumbs";

// Setup
const ctrl = new VesselCtrl()
async function setupVesselDetail(props = { id: null }) {
  const vpNo = props.id
  render(setupAppCrumbs({ reset: true, vpNo }), { id: false })
  const store = ctrl.getStore(vpNo)
  const vessel = await store.getOne(vpNo)

  return {
    template:  /*HTML*/ `
<!-- Update an embedded template. -->
<div>
  <div class="usa-card__container">
    <div class="usa-card__header">
      <h2 class="usa-card__heading">Vessel Detail</h2>
    </div>

    <div class="usa-card__media">
      <!--<div class="usa-card__img">
        <img
          id="vessel-img"
          src=""
          alt="Permit Number: ${vessel.vpNo}"
        />
      </div> -->
    </div>

    <div class="usa-card__body">
      <div>
        <label for="vessel-name" class="usa-label">Vessel Name</label>
        <input id="vessel-name" class="usa-input" value="${vessel.name}"></input>
      </div>

      <div>
        <label for="vessel-id" class="usa-label">Vessel Permit Number</label>
        <input id="vessel-id" class="usa-input" value="${vessel.vpNo}"></input>
      </div>
    </div>

    <div class="usa-card__footer">
      <a href="/trip?vpNo=${vessel.vpNo}" class="usa-button" data-navigo>Trips</a>
      <button class="usa-button"
        disabled
        href="/haul?vpNo=${vessel.vpNo}"
        data-navigo
      >Hauls</button>

      <button class="usa-button"
        disabled
        data-navigo
      >Catches</button>
    </div>
  </div>
</div>
`
  }
}

export { setupVesselDetail };

import { HaulStore } from "../store/haul"
import { router } from "../main"
import { getDateNow, render } from "../app-lib"
import { location } from "../geo-location"
import { getMap } from "../mapping"

import { setupAppCrumbs } from "./app-crumbs"

/*
  Haul End
  Input: End Date, End GPS;
    - end-date, end-gps
  Btn: End Haul
    - end-haul
*/

async function setupHaulEnd(props = { id, vpNo, tripId }) {
  const haulId = props.id
  const vpNo = props.vpNo
  const tripId = props.tripId

  render(setupAppCrumbs({ vpNo, tripId, msg: 'Haul End' }), { id: false })

  const store = new HaulStore({ vpNo, tripId })
  const haul = await store.getOne(haulId)
  console.log('hl end: %o', haul)

  return {
    template: /*html*/ `
<div class="margin-3">
  <form class="usa-form" id="grok_form_login" action="#">
    <fieldset class="usa-fieldset">
      <legend class="usa-legend usa-legend--large">End Haul</legend>

      <label class="usa-label" for="start-date">Start Date</label>
      <input class="usa-input"
        id="start-date"
        title="Start Date"
        name="start-date"
        value="${ haul.startDate }"
        disabled
      ></input>

      <label class="usa-label" for="end-date">End Date</label>
      <input class="usa-input"
        id="end-date"
        title="End Date"
        name="end-date"
        value="${ getDateNow() }"
      ></input>

      <label class="usa-label" for="end-gps">End GPS</label>
      <input class="usa-input"
        id="end-gps"
        title="End GPS"
        name="end-gps"
        value="${ await location() }"
      ></input>

      <button class="usa-button usa-button--accent-warm margin-left-105"
        id="map-btn"
        name="map-btn"
        type="button"
      >
        Show Map
      </button>

      <input class="usa-button"
        id="end-haul"
        type="submit"
        name="end-haul"
        value="End Haul"
      ></input>
    </fieldset>
  </form>

  <div class="margin-3" id="map" style="width:900px; height:580px"></div>

</div>
    `,
    onAfter: el => {
      el.querySelector("#end-haul")
        .addEventListener("click", (e) => endHaul(e, haul))
      el.querySelector("#map-btn").addEventListener("click", getMap)
    }
  }
}


async function endHaul(e, haul) {
  e.preventDefault();
  haul.endGps = document.querySelector("#end-gps").value;
  haul.endDate = document.querySelector("#end-date").value;

  const store = new HaulStore()
  haul = await store.addOne(haul)
  router.navigate(`/haul/${haul.id}?vpNo=${haul.vpNo}&tripId=${haul.tripId}`)
}



export {
  setupHaulEnd
}

import { HaulCtrl } from "../controller/haul";
import { HaulStore } from "../store/haul";
import { router } from "../main";
import { getDateNow } from "../app-lib"
import { location } from "../geo-location"
import { getMap } from "../mapping"

const ctrl = new HaulCtrl();
async function setupHaulStart(props = { tripId: null, vpNo: null }) {
  // const haulId = props.haulId
  const tripId = props.tripId
  const vpNo = props.vpNo

  const store = ctrl.getStore(vpNo, tripId );
/*
  Start Haul
  Input: Start Date, Start GPS;
   - start-date, start-gps
  Btn: Start Haul
   - start-haul
*/

  return {
    template: /*html*/ `
<div class="margin-3">
  <form class="usa-form" id="grok_form_login" action="#">
    <fieldset class="usa-fieldset">
      <legend class="usa-legend usa-legend--large">Start Haul</legend>

      <label class="usa-label" for="start-date">Start Date</label>
      <input class="usa-input"
        id="start-date"
        title="Start Date"
        name="start-date"
        value="${ getDateNow() }"
      ></input>

      <label class="usa-label" for="start-gps">Start GPS</label>
      <input class="usa-input"
        id="start-gps"
        title="Start GPS"
        name="start-gps"
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
        id="start-haul"
        type="submit"
        name="start-haul"
        value="Start Haul"
      ></input>
    </fieldset>
  </form>

  <div class="margin-3" id="map" style="width:900px; height:580px"></div>

</div>
    `,
    onAfter: async (el) => {
      // el.querySelector("#start-gps").value = await location();
      // el.querySelector("#start-date").value = getHaulStartTime();
      el.querySelector("#start-haul")
        .addEventListener("click", (e) => addHaul(e, { vpNo, tripId }));
      el.querySelector("#map-btn").addEventListener("click", getMap);
    }
  }

}

async function addHaul(e, haul) {
  e.preventDefault();
  haul.startGps = document.querySelector("#start-gps").value;
  haul.startDate = document.querySelector("#start-date").value;

  const store = new HaulStore()
  haul = await store.addOne(haul);
  router.navigate(`/haul/${haul.id}?vpNo=${haul.vpNo}&tripId=${haul.tripId}`)
}


export { setupHaulStart };

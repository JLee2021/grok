/*Start Haul
Input: Start Date, Start GPS;
Btn: Start Haul
*/
import template from "./haul-start.html?raw";
import { HaulCtrl } from "../controller/haul";
import { getMap } from "/src/mapping.js";
import { showPosition } from "/src/geo-location.js";
import { router } from "../main";

async function location() {
  let position = await showPosition();
  return `${position.coords.latitude}, ${position.coords.longitude}`;
}

function getHaulStartTime() {
  let date = new Date(); // based on device being correct

  const options = {
    year: "2-digit",
    month: "short",
    day: "2-digit",
    hour: "2-digit",
    minute: "numeric",
    second: "numeric",
  };

  return date.toLocaleDateString("en-GB", options); // I want dd mmm yy, hh:mm:ss (24hr clock, GB does it right)
}

const ctrl = new HaulCtrl();
async function setupHaulStart(props = { tripId: null }) {
  const tripId = props.tripId
  const store = ctrl.getStore(tripId);

  return {
    template,
    onAfter: async (el) => {
      el.querySelector("#start-gps").value = await location();
      el.querySelector("#start-date").value = getHaulStartTime();
      el.querySelector("#start-haul")
        .addEventListener("click", (e) => addHaul(e, tripId));

      el.querySelector("#map-btn").addEventListener("click", (e) => getMap());
    }
  }

}

async function addHaul(e, tripId) {
  e.preventDefault();
  const startGps = document.querySelector("#start-gps").value;
  const startDate = document.querySelector("#start-date").value;
  await ctrl.getStore(tripId).addOne({ tripId, startGps, startDate });

  router.navigate(`/haul/${tripId}`)
}


export { setupHaulStart };

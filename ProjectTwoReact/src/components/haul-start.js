/*Start Haul
Input: Start Date, Start GPS;
Btn: Start Haul
*/
import { HaulCtrl } from "../controller/haul";
import { setupHaulList } from "./haul-list";
import template from "./haul-start.html?raw";
import { showPosition } from "/src/geo-location.js";

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

const ctrl = new HaulCtrl()
async function setupHaulStart(el, { tripId = null } = { tripId: null }) {
  console.log('Setting Haul for Trip: %o', tripId)
  const store = ctrl.getStore(tripId)
  el.innerHTML = template;

  document.querySelector("#start-gps").value = await location();
  document.querySelector("#start-date").value = getHaulStartTime();
  document.querySelector('#start-haul').addEventListener('click', (e) => addHaul(e, tripId))

  // Update Species & Dispostion Lists
  // el.querySelector('#list-species').innerHTML = listSpecies()
  // el.querySelector('#list-dispo').innerHTML = listDispo()
}

async function addHaul(e, tripId) {
  e.preventDefault()
  const startGps = document.querySelector("#start-gps").value
  const startDate = document.querySelector("#start-date").value
  await ctrl.getStore(tripId).addOne({ tripId, startGps, startDate })
  toHaulList(tripId)
}

function toHaulList(tripId) {
  setupHaulList(document.querySelector('#main-content'), { tripId })
}


export { setupHaulStart };

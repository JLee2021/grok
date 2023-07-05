/*Start Haul
Input: Start Date, Start GPS;
Btn: Start Haul
*/
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

async function setupHaulStart(el) {
  el.innerHTML = template;

  document.querySelector("#start-gps").value = await location();
  document.querySelector("#start-date").value = getHaulStartTime();

  // Update Species & Dispostion Lists
  // el.querySelector('#list-species').innerHTML = listSpecies()
  // el.querySelector('#list-dispo').innerHTML = listDispo()
}

export { setupHaulStart };

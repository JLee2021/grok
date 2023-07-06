/*
  List Vessels
  List: Vessels -> trip-list.js
   - vessel-list
*/
import template from "./vessel-list.html?raw";
import { VesselCtrl } from "../controller/vessel";
import { vesselApi } from "../service/api";
import { watch } from "../app-lib";

import { setupTripList } from "./trip-list";

vesselApi.get();

// Setup
async function setupVesselList(el) {
  const vessels = await new VesselCtrl().getStore().getRef();

  // Update Component
  async function update(el) {
    console.info("Updating Vessel List");
    el.innerHTML = template;

    // Add Actions
    el.querySelector("#vessel-list").innerHTML = listVessels(
      vessels.value || []
    );
    Array.from(el.querySelectorAll(".vessel")).map((item) =>
      item.addEventListener("click", toTripList)
    );
  }

  watch(vessels, (n, o) => update(el), { id: 'vesselList' });
  update(el);
}

// Fragments
function listVessels(items) {
  return `
    <div>
      ${items
        .map(
          (item) => `
      <li>
        <a class="vessel" href="javascript:void 0" data-id="${item.vpNo}">
          ${item.name}
        </a> - ${item.vpNo}
      </li>`
        )
        .join("")}
    </div>
  `;
}

// Actions
function toTripList(el) {
  el.preventDefault();
  // Grab vessel permit no. from data-id attribute.
  const vpNo = el.target.dataset.id;
  setupTripList(document.querySelector("#main-content"), { vpNo });
}

export { setupVesselList };

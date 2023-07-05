import template from "./haul-list.html?raw";
import { setupHaulStart } from "./haul-start";
import { HaulCtrl } from "../controller/haul";
import { watch } from "../app-lib";

/*
  List Haul
  Btn: Add New Haul;
   - add-haul
  List: Hauls -> haul-start.js
   - haul-list
*/

// Setup
async function setupHaulList(el) {
  const hauls = await new HaulCtrl().getStore().getRef();

  // Update Component
  async function update(el) {
    console.info("Updating Haul List");
    el.innerHTML = template;

    // Update Trip List
    el.querySelector("#haul-list").innerHTML = listHauls(hauls.value || []);
    el.querySelector("#add-haul").addEventListener("click", toStartHaul);
  }

  watch(hauls, (n, o) => update(el));
  update(el);
}

// Fragments
function listHauls(items) {
  return `
    <di>
      ${items.map((item) => `<li>${item.name} - ${item.id}</li>`).join("")}
    </di>
  `;
}

// Actions
function toStartHaul() {
  setupHaulStart(document.querySelector("#main"));
}

export { setupHaulList };

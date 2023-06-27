import { VesselCtrl } from "./controller/vessel"
import { vesselApi } from "./service/api"
import { watch } from "./app-lib"

const ctrl = new VesselCtrl()
const store = ctrl.getStore()
// const model = ctrl.getModel()
let vessels = store.getRef()

export function setupVesselList(element) {
  watch(vessels, update)

  function update() {
    console.info('Updateing Vessel List')

    element.innerHTML = `
      <div> <h3>Menu</h3>
        <div>
          <button id="vessel-update">(demo) Load From Server</button>
          <button id="vessel-cleardb" style="padding-left: 8px">Clear DB</button>
        </div>

      <table>
        <thead>
          <tr>
            <th>Vessel</th><th>Id</th>
          </tr>
        </thead>
        <tbody>
        ${vessels.value.map(v => `
          <tr>
            <td>${v?.name || 'NoName'}</td><td>${v.vpNo || 'NoID'}</td>
          </tr>
        `).join('')}
        </tbody>
      </table>
    `

    // Events
    element.querySelector('#vessel-update').addEventListener('click', vesselApi.get)
    element.querySelector('#vessel-cleardb').addEventListener('click', store.deleteAll)

    // Handle Navigation Links
    Array.from(document.querySelectorAll('#vessel-trip')).forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        setupVesselTrip(document.querySelector('#main'))
        return
      })
    })

  }


  update()
}

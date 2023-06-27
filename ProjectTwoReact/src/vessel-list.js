import { VesselCtrl } from "./controller/vessel"

const ctrl = new VesselCtrl()
const model = ctrl.getModel()
const store = ctrl.getStore()

export function setupVesselList(element) {
  const update = async () => {
    let vessels = await model.getVessel()
    console.log('vessels: %o', vessels)
    element.innerHTML = `
      <div> <h3>Menu</h3>
        <div>
          <button id="vessel-update">Load Vessels</button>
          <button id="vessel-cleardb" style="padding-left: 8px">Clear DB</button>
        </div>

      <table>
        <thead>
          <tr>
            <th>Vessel</th><th>Id</th>
          </tr>
        </thead>
        <tbody>
        ${vessels.map(v => `
          <tr>
            <td>${v?.name || 'NoName'}</td><td>${v.id || 'NoID'}</td>
          </tr>
        `).join('')}
        </tbody>
      </table>
    `

    // Events
    element.querySelector('#vessel-update').addEventListener('click', () => update())
    element.querySelector('#vessel-cleardb').addEventListener('click', () => store.clearAll())
  }


  update()
}

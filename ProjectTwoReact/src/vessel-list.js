import { VesselCtrl } from "./controller/vessel"

const ctrl = new VesselCtrl()
const model = ctrl.getModel()

export function setupVesselList(element) {
  const update = () => {
    let vessels = model.getVessel()
    element.innerHTML = `
      <div>
        <button id="vessel-update">Load Vessels</button>
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
  }


  update()
}

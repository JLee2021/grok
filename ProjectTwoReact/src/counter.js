import { VesselCtrl } from "./controller/vessel"
const vslCtrl = new VesselCtrl()
const vslModel = vslCtrl.getModel()

const vpNoBase = 10000

export function setupCounter(element) {
  let counter = 0
  const setCounter = (count) => {
    counter = count
    vslModel.store.addOne({
      name: `Test-${count}`,
      id: vpNoBase + count
    })
    element.innerHTML = `count is ${counter}`
  }
  element.addEventListener('click', () => setCounter(counter + 1))
  setCounter(0)
}

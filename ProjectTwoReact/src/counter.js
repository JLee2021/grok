import { vesselApi } from "./service/api"
(async () => {
  const vessels = await vesselApi.get()
  console.info('Vessels: %o', vessels)
})()

export function setupCounter(element) {
  let counter = 0
  const setCounter = (count) => {
    counter = count
    element.innerHTML = `count is ${counter}`
  }
  element.addEventListener('click', () => setCounter(counter + 1))
  setCounter(0)
}

import { watch } from "./app-lib"
import { vesselApi } from "./service/api"
import { vessel } from "./store/vessel"

// Make an API request for vessels.
vesselApi.get()

export function setupCounter(element) {
  console.info('setup vessel watcher')
  watch(vessel, (n, o) => {
    console.log('Updating Component')
    console.log('New Value: %o', n)
    console.log('Old Value: %o', o)

    setCounter(n.length)
  })

  let counter = 0
  const setCounter = (count) => {
    counter = count
    element.innerHTML = `count is ${counter}`
  }
  element.addEventListener('click', () => setCounter(counter + 1))
  setCounter(0)
}

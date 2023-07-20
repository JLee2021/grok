// import '../assets/style.css'
import Navigo from "navigo";
import { render } from "./app-lib";
import { vesselApi } from "./service/vessel-api";
import 'leaflet/dist/leaflet.css'

import { setupLogin } from "./components/login";
import { setupVesselDetail } from "./components/vessel-detail";
import { setupVesselList } from "./components/vessel-list";
import { setupTripDetail } from "./components/trip-detail";
import { setupTripList } from "./components/trip-list";
import { setupTripStart } from "./components/trip-start";
import { setupTripEnd } from "./components/trip-end";
import { setupHaulDetail } from "./components/haul-detail";
import { setupHaulList } from "./components/haul-list";
import { setupHaulStart } from "./components/haul-start";
import { setupHaulEnd } from "./components/haul-end";
import { setupCatchList } from "./components/catch-list";
import { setupCatchAdd } from "./components/catch-add";

const hostPath = import.meta.env.VITE_HOST_PATH
console.log('host path: %o', hostPath)
const router = new Navigo(hostPath, { hash: true })

router.on({
  '/': {
    uses: () => {
      render(setupLogin())
    },
    hooks: {
      before: (done, match) => {
        // Only for the Login Component
        // Close the nav bar before uswds lib errors out on key down event.
        // uswds fires key down event for some reason during routing.
        // email input related; possibly autocomplete??

        // Close Nav Bar before navigating to /.
        document.querySelector('.usa-nav__close').click()
        done()
      }
    }
  },
  '/vessel': ({ data }) => (setupVesselList(data)),
  '/vessel/:id': async ({ data }) => {
    try { // Refresh from API.
      await vesselApi.get()
    } catch(e) {
      console.log('Error: ', e)
    }
    render(setupVesselDetail(data))
  },

  // Trips
  '/trip': ({ params }) => render(setupTripList(params)),
  '/trip/:id': ({ data, params }) => {
    if (data.id === 'start') { return }
    render(setupTripDetail({ ...data, ...params }))
  },
  '/trip/start': ({ params }) => render(setupTripStart(params)),
  '/trip/:id/end': ({ data, params }) =>
    render(setupTripEnd({ ...data, ...params })),
  // '/trips/:id/edit': ({ data, params }) =>
  //   render(setupTripEdit({ ...data, ...params })),

  // Hauls or Efforts
  '/haul': ({ params }) => render(setupHaulList(params)),
  '/haul/:id': ({ data, params }) => {
    if (data.id === 'start') { return }
    render(setupHaulDetail({ ...data, ...params }))
  },
  '/haul/start': ({ params }) => render(setupHaulStart(params)),
  '/haul/:id/end': ({ data, params }) =>
    render(setupHaulEnd({ ...data, ...params })),

  // Catches
  '/catch': ({ params}) => render(setupCatchList(params)),
  '/catch/:id': ({ data, params }) => {
    if (data.id === 'start') { return }
    render(setupCatchDetail({ ...data, ...params }))
  },
  '/catch/:id/add': ({ data, params}) =>
    render(setupCatchAdd({ ...data, ...params })),

})


// Routing does not close the nav bar; Force it closed.
document.querySelector('.route-navigo').addEventListener('click', () => {
  document.querySelector('.usa-nav__close').click()
})

router.resolve()

export { router }

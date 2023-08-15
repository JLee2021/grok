// import '../assets/style.css'
import Navigo from "navigo";
import { render } from "./app-lib";
import { vesselApi } from "./service/vessel-api";

import 'leaflet/dist/leaflet.css'
import '@uswds/uswds/css/uswds.min.css'

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
import { setupAppMain } from './app-main.js';

const hostPath = import.meta.env.VITE_HOST_PATH
console.log('host path: %o', hostPath)

// console.log('template: %o', template)
render(setupAppMain(), { id: 'app-main' })



const router = new Navigo(hostPath, { hash: true })

// Always route to root if no route is found.
router.notFound(() => {
  console.log(' navigo: No route found.')
  router.navigate('/')
});

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

        // Close Nav Bar before navigating to /; Ignore on app load.
        document.querySelector('.usa-nav__close')?.click()
        done()
      }
    }
  },
  '/vessel': ({ data }) => render(setupVesselList(data)),
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


// Initialize Main date components.
// const b = document.getElementById('test-a2')
// console.log(b)
// datePicker.on()
// datePicker.init(b)
// initComponets


router.resolve()

export { router }

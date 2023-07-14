// import '../assets/style.css'
import Navigo from "navigo";
import { render } from "./app-lib";

import { setupLogin } from "./components/login";
import { setupVesselList } from "./components/vessel-list";
import { setupTripList } from "./components/trip-list";
import { setupTripStart } from "./components/trip-start";
import { setupHaulList } from "./components/haul-list";
import { setupHaulStart } from "./components/haul-start";
import { setupCatchList } from "./components/catch-list";
import { setupCatchAdd } from "./components/catch-add";
import { vesselApi } from "./service/vessel-api";

const hostPath = import.meta.env.VITE_HOST_PATH
console.log('host path: %o', hostPath)
const router = new Navigo(hostPath, { hash: true })

// router.on({
//   '/': {
//     uses: () => {
//       render(setupLogin())
//     },
//     hooks: {
//       before: (done, match) => {
//         document.querySelector('.usa-nav__close').click()
//         done()
//       }
//     }
//   },
//   '/another': {
//     uses: ({ data }) => {

//     }
//   }
// })

// router.on('/', async function() {
//   // Root is currently: Login
//   render(setupLogin())
// }, {
//   before(done, match) {
//     // Routing does not close the nav bar; force it closed.
//     document.querySelector('.usa-nav__close').click()
//     done()
//   }
// })

// .on('/vessels', async () => {
//   // Try to update the w/API everytime.
//   try {
//     await vesselApi.get()
//   } catch(e) {
//     console.log('Error: ', e)
//   }
//   render(setupVesselList())

// })

// .on('/vessels/:id', ({ data }) => {
//   render(setupVesselList({ vpNo: data.id }))

// })


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
  '/vessels': {
    uses: async () => {
      try {
        // Try to update the w/API everytime.
        await vesselApi.get()
      } catch(e) {
        console.log('Error: ', e)
      }
      render(setupVesselList())
    }
  },
  '/vessels/:id': {
    uses: ({ data }) => {
      render(setupVesselList({ vpNo: data.id }))
    },
  },
  '/trips/:id': {
    uses: ({ data }) => {
      render(setupTripList({ vpNo: data.id }))
    }
  },
  '/trips/:id/start': {
    uses: ({ data }) => {
      render(setupTripStart({ vpNo: data.id }))
    }
  },
  '/haul/:id': {
    uses: ({ data }) => {
      render(setupHaulList({ tripId: data.id }))
    }
  },
  '/haul/:id/start': {
    uses: ({ data }) => {
      render(setupHaulStart({ tripId: data.id }))
    }
  },
  '/catch/:id': {
    uses: ({ data }) => {
      render(setupCatchList({ haulId: data.id }))
    }
  },
  '/catch/:id/add': {
    uses: ({ data }) => {
      render(setupCatchAdd({ haulId: data.id }))
    }
  },
})


// router.on('/', async function() {
//   // Root is currently: Login
//   render(setupLogin())
// }, {
//   before(done, match) {
//     document.querySelector('.usa-nav__close').click()
//     done()
//   }

// })
// .on('/vessels', async () => {
//   // Try to update the w/API everytime.
//   try {
//     await vesselApi.get()
//   } catch(e) {
//     console.log('Error: ', e)
//   }
//   render(setupVesselList())

// }).on('/vessels/:id', ({ data }) => {
//   render(setupVesselList({ vpNo: data.id }))

// }).on('/trips/:id', ({ data }) => {
//   render(setupTripList({ vpNo: data.id }))

// }).on('/trips/:id/start', ({ data }) => {
//   render(setupTripStart({ vpNo: data.id }))

// }).on('/haul/:id', ({ data }) => {
//   render(setupHaulList({ tripId: data.id }))

// }).on('/haul/:id/start', ({ data }) => {
//   render(setupHaulStart({ tripId: data.id }))

// }).on('/catch/:id', ({ data }) => {
//   render(setupCatchList({ haulId: data.id }))

// }).on('/catch/:id/add', ({ data }) => {
//   render(setupCatchAdd({ haulId: data.id }))

// })

// Routing does not close the nav bar; Force it closed.
document.querySelector('.route-navigo').addEventListener('click', () => {
  document.querySelector('.usa-nav__close').click()
})

router.resolve()

export { router }

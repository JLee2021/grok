import { VesselCtrl } from "../controller/vessel"
import { TripCtrl } from "../controller/trip"

// const ctrl = new VesselCtrl()
const vesselStore = (new VesselCtrl()).getStore()
const tripStore = (new TripCtrl()).getStore()

const service = import.meta.env.VITE_API

export const vesselApi = (() => {
  async function get() {
    return fetch(`${service}/select_options/vessel_permit_num`)
      .then(async res => await res.json() || [])
      .then(body => {
        // Clean up the response.
        const rows = (body).map(item => ({
          name: item?.name || null,
          vpNo: item?.value || null
        }))

        // Replace all vessels with new data.
        vesselStore.addMany(rows)

        return rows
      })
  }

  return {
    get
  }
})()

export const tripApi = (() => {
  async function get() {
    tripStore.addMany([{
      vpNo: '880639',
      obsId: 'trip one',
      id: '1',
    }, {
      vpNo: '880639',
      obsId: 'trip two',
      id: '2',
    }, {
      vpNo: '880639',
      obsId: 'trip three',
      id: '3',
    }])

    // return fetch(`${service}/select_options/${_get_trip_path_goes_here}`) // ToDo: set path
    //   .then(async res => await res.json() || [])
    //   .then(body => {
    //     // Clean up the response.
    //     const rows = (body).map(item => ({
    //     }))

    //     // Update Application Data.
    //     tripStore.addMany(rows)

    //     return rows
    //   })
  }

  return {
    get
  }
})()

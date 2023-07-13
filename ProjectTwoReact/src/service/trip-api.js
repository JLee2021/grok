import { TripCtrl } from "../controller/trip"
const service = import.meta.env.VITE_API

export const tripApi = {
  async get() {
    const tripStore = (new TripCtrl()).getStore()

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

}

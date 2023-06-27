import { VesselCtrl } from "../controller/vessel"

// const ctrl = new VesselCtrl()
const vesselStore = (new VesselCtrl()).getStore()
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

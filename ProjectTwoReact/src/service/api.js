import { vessel } from "../store/vessel"

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
        if (rows.length > 1) {
          vessel.value.splice(0, vessel.value.length, rows)
        }

        return rows
      })
  }

  return {
    get
  }
})()

const service = import.meta.env.VITE_API

export const vesselApi = (() => {
  async function get() {
    return fetch(`${service}/select_options/vessel_permit_num`)
      .then(async res => await res.json() || [])
      // Clean up the response.
      .then(body => {
        return (body).map(item => ({
          name: item?.name || null,
          vpNo: item?.value || null
        }))
      })
  }

  return {
    get
  }
})()

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Bluetooth API</title>
  </head>
  <body>
    <p>
      Reference:
      <a href="https://developer.chrome.com/articles/bluetooth/">https://developer.chrome.com/articles/bluetooth/</a>
    </p>
    <button>Bluetooth Connect</button>
    <script>
      const button = document.querySelector("button");
      button.addEventListener("click", async function () {
        navigator.bluetooth
          .requestDevice({
            acceptAllDevices: true,
            optionalServices: ["battery_service"], // Required to access service later.
          })
          .then((device) => {
            /* … */
          })
          .catch((error) => {
            console.error(error.message);
          });
      });
    </script>
  </body>
</html>

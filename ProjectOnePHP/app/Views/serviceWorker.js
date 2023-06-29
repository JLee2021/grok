const staticGrok = "dev-grok-v1"; // declare name of cache
const assets = [ // files to precache
  "/",
  "/index.html",
  "/css/styles.css",  // /assets/css/styles.css
  "/uswds/uswds/js/uswds.min.js",   // /assets/uswds/uswds/js/uswds.min.js
  "/js/app.js",
  "/dashboard-trip.php",
  "/dashboard-user.php",
  "/end-haul.php",
  "/gps.php",
  "/log-catch.php",
  "/login.php",
  "/new-catch.php",
  "/new-haul.php",
  "/new-trip.php",
  "/splash.php",
  "/welcome_message.php"
];

self.addEventListener("install", installEvent => { // run install event
  installEvent.waitUntil(
    caches.open(staticGrok).then(cache => {
      cache.addAll(assets); // returns a promise
    })
  );
});

self.addEventListener("fetch", fetchEvent => { // fetch our cache if offline
  fetchEvent.respondWith(
    caches.match(fetchEvent.request).then(res => {
      return res || fetch(fetchEvent.request);
    })
  );
});
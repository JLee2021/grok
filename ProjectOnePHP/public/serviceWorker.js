const staticDevGrok = 'dev-grok-v1';
const assets1 = [  // List the files to precache
    //'/',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/assets/css/styles.css',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/assets/js/app.js',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/assets/uswds/uswds/js/',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/dashboard',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/new_trip',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/dashboard_trip',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/dashboard_trip/',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/new_haul',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/end_haul',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/dashboard_haul',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/new_catch',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/home/log_catch'

/*
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/assets/uswds/uswds/fonts/',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/assets/img/',
    'https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/assets/uswds/uswds/fonts/source-sans-pro/',
*/

];

const assets = [  // List the files to precache
    //'/',
    //'http://127.0.0.1:8080/grok/ProjectOnePHP/public/',
    //'http://127.0.0.1:8080/grok/ProjectOnePHP/public/index.php',
    'http://127.0.0.1:8080/grok/ProjectOnePHP/public/assets/css/styles.css',
    'http://127.0.0.1:8080/grok/ProjectOnePHP/public/assets/js/app.js',
    'http://127.0.0.1:8080/grok/ProjectOnePHP/public/assets/uswds/uswds/js/',
    'http://127.0.0.1:8080/grok/ProjectOnePHP/public/index.php/home/dashboard'
];

self.addEventListener("install", installEvent => {
    self.skipWaiting(); // Activate immediately

    installEvent.waitUntil( // install event to wait until we’ve cached our files before completing
      caches.open(staticDevGrok).then(cache => { // Cache Storage API
        cache.addAll(assets); // return promise
      })
      .then(() => {
        console.log("Assets cached successfully");
      })
      .catch(error => {
        console.log("Caching failed:", error);
      })
    );
});

self.addEventListener('activate', (event) => {
  console.log('Service worker activate event!');
});


self.addEventListener("fetch", fetchEvent => {
    fetchEvent.respondWith(
      caches.match(fetchEvent.request).then(res => {
        return res || fetch(fetchEvent.request);
      })
    );
});

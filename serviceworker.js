const staticvoid = "static-v2"
const assets = [
  "/",
  "/index.html",
  "/index.css",
  "/index.js"
]

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(staticvoid).then(cache => {
      cache.addAll(assets)
    })
  )
})
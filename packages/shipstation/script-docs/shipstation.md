# ShipStation

Namespace: `shipstation`

Use ShipStation tools for the ShipStation API V2 surface: batches, carriers, downloads, fulfillments, inventory, labels, mailing, manifests, pickups, package types, products, purchase orders, rates, shipments, suppliers, tags, totes, tracking, warehouses, users, and webhooks.

ShipStation V2 authenticates with the `API-Key` header. The default API root is `https://api.shipstation.com`; tools include the `/v2` path prefix.

JSON responses are returned as `{ status = 200, data = { ... } }`. Empty successful responses return `{ status = 204, success = true }`.

Use `shipstation_api_get`, `shipstation_api_post`, `shipstation_api_put`, `shipstation_api_patch`, and `shipstation_api_delete` for supported V2 paths not represented by a named tool. Raw paths must be relative, for example `/v2/shipments`; absolute URLs are rejected.

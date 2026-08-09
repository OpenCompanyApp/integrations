# Atlassian Statuspage

JavaScript API reference for the `statuspage` integration package. These tools use the Statuspage Manage API and require an API key plus a default `page_id`.

Use `statuspage_list_pages` first when you need to discover the correct page ID. Page-scoped tools then operate on the configured page unless a tool explicitly accepts `page_id`.

## Pages and User

### `statuspage_get_current_user`

Verify the API key and inspect the authenticated user.

```js
var user = statuspage_get_current_user()
console.log(user.email)
```
### `statuspage_list_pages`

List pages visible to the API key.

```js
var pages = statuspage_list_pages({ per_page: 25 })
for (const page of (pages)) {
  console.log(page.id, page.name)
}
```
### `statuspage_get_page`

Get details for the configured page or another visible page.

```js
var page = statuspage_get_page()
console.log(page.name)

var other = statuspage_get_page({ page_id: "page-test" })
console.log(other.id)
```
## Incidents

### `statuspage_list_incidents`

List incidents for the configured page. The Statuspage API may include resolved, active, and scheduled incidents.

```js
var incidents = statuspage_list_incidents({ limit: 10, page: 1 })
for (const incident of (incidents)) {
  console.log(incident.id, incident.name, incident.status)
}
```
### `statuspage_list_unresolved_incidents`

List incidents that are still unresolved.

```js
var open_incidents = statuspage_list_unresolved_incidents({ limit: 10 })
```
### `statuspage_list_upcoming_incidents`

List upcoming scheduled maintenance incidents.

```js
var upcoming = statuspage_list_upcoming_incidents({ limit: 10 })
```
### `statuspage_create_incident`

Create a new incident or scheduled maintenance entry. `status` should match Statuspage values such as `investigating`, `identified`, `monitoring`, `resolved`, `scheduled`, `in_progress`, `verifying`, or `completed`.

```js
var incident = statuspage_create_incident({
  name: "Example API latency",
  status: "investigating",
  impact: "minor",
  body: "We are investigating elevated latency.",
  component_ids: [ "component-test" ],
})
console.log(incident.id)
```
For scheduled maintenance:

```js
var maintenance = statuspage_create_incident({
  name: "Example database maintenance",
  status: "scheduled",
  impact: "none",
  body: "A maintenance window is scheduled.",
  scheduled_for: "2026-06-01T10:00:00Z",
  scheduled_until: "2026-06-01T11:00:00Z",
})
```
### `statuspage_update_incident`

Update only the fields you provide. To resolve a live incident, update `status` to `resolved`.

```js
var updated = statuspage_update_incident({
  id: "incident-test",
  status: "monitoring",
  body: "Latency has returned to normal && we are monitoring.",
})
```
### `statuspage_delete_incident`

Delete an incident from the configured page. Prefer resolving real incidents instead of deleting them when preserving history matters.

```js
var result = statuspage_delete_incident({ id: "incident-test" })
console.log(result.deleted)
```
## Components

### `statuspage_list_components`

List components on the configured page.

```js
var components = statuspage_list_components({ per_page: 100 })
for (const component of (components)) {
  console.log(component.id, component.name, component.status)
}
```
### `statuspage_get_component`

Get one component by ID.

```js
var component = statuspage_get_component({ id: "component-test" })
console.log(component.name)
```
### `statuspage_create_component`

Create a component. Supported statuses include `operational`, `degraded_performance`, `partial_outage`, `major_outage`, and `under_maintenance`.

```js
var component = statuspage_create_component({
  name: "Example API",
  status: "operational",
  description: "Primary public API.",
})
console.log(component.id)
```
### `statuspage_update_component`

Update component metadata or status. Only provided fields are sent.

```js
var component = statuspage_update_component({
  id: "component-test",
  status: "degraded_performance",
})
```
### `statuspage_delete_component`

Delete a component from the configured page.

```js
var result = statuspage_delete_component({ id: "component-test" })
console.log(result.deleted)
```
## Return Shapes

Most tools return Statuspage API objects with fields such as `id`, `name`, `status`, `impact`, `created_at`, and `updated_at`. Delete tools return a small confirmation object:

```js
const example = { deleted: true, id: "incident-test" }
```
## Multi-Account Usage

Use the namespace prefix assigned by the host:

```js
var incidents = ns_statuspage_ops.statuspage_list_incidents({ limit: 5 })
```
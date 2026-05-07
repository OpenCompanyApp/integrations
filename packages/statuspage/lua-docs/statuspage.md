# Atlassian Statuspage

Lua API reference for the `statuspage` integration package. These tools use the Statuspage Manage API and require an API key plus a default `page_id`.

Use `statuspage_list_pages` first when you need to discover the correct page ID. Page-scoped tools then operate on the configured page unless a tool explicitly accepts `page_id`.

## Pages and User

### `statuspage_get_current_user`

Verify the API key and inspect the authenticated user.

```lua
local user = statuspage_get_current_user()
print(user.email)
```

### `statuspage_list_pages`

List pages visible to the API key.

```lua
local pages = statuspage_list_pages({ per_page = 25 })
for _, page in ipairs(pages) do
  print(page.id, page.name)
end
```

### `statuspage_get_page`

Get details for the configured page or another visible page.

```lua
local page = statuspage_get_page()
print(page.name)

local other = statuspage_get_page({ page_id = "page-test" })
print(other.id)
```

## Incidents

### `statuspage_list_incidents`

List incidents for the configured page. The Statuspage API may include resolved, active, and scheduled incidents.

```lua
local incidents = statuspage_list_incidents({ limit = 10, page = 1 })
for _, incident in ipairs(incidents) do
  print(incident.id, incident.name, incident.status)
end
```

### `statuspage_list_unresolved_incidents`

List incidents that are still unresolved.

```lua
local open_incidents = statuspage_list_unresolved_incidents({ limit = 10 })
```

### `statuspage_list_upcoming_incidents`

List upcoming scheduled maintenance incidents.

```lua
local upcoming = statuspage_list_upcoming_incidents({ limit = 10 })
```

### `statuspage_create_incident`

Create a new incident or scheduled maintenance entry. `status` should match Statuspage values such as `investigating`, `identified`, `monitoring`, `resolved`, `scheduled`, `in_progress`, `verifying`, or `completed`.

```lua
local incident = statuspage_create_incident({
  name = "Example API latency",
  status = "investigating",
  impact = "minor",
  body = "We are investigating elevated latency.",
  component_ids = { "component-test" },
})
print(incident.id)
```

For scheduled maintenance:

```lua
local maintenance = statuspage_create_incident({
  name = "Example database maintenance",
  status = "scheduled",
  impact = "none",
  body = "A maintenance window is scheduled.",
  scheduled_for = "2026-06-01T10:00:00Z",
  scheduled_until = "2026-06-01T11:00:00Z",
})
```

### `statuspage_update_incident`

Update only the fields you provide. To resolve a live incident, update `status` to `resolved`.

```lua
local updated = statuspage_update_incident({
  id = "incident-test",
  status = "monitoring",
  body = "Latency has returned to normal and we are monitoring.",
})
```

### `statuspage_delete_incident`

Delete an incident from the configured page. Prefer resolving real incidents instead of deleting them when preserving history matters.

```lua
local result = statuspage_delete_incident({ id = "incident-test" })
print(result.deleted)
```

## Components

### `statuspage_list_components`

List components on the configured page.

```lua
local components = statuspage_list_components({ per_page = 100 })
for _, component in ipairs(components) do
  print(component.id, component.name, component.status)
end
```

### `statuspage_get_component`

Get one component by ID.

```lua
local component = statuspage_get_component({ id = "component-test" })
print(component.name)
```

### `statuspage_create_component`

Create a component. Supported statuses include `operational`, `degraded_performance`, `partial_outage`, `major_outage`, and `under_maintenance`.

```lua
local component = statuspage_create_component({
  name = "Example API",
  status = "operational",
  description = "Primary public API.",
})
print(component.id)
```

### `statuspage_update_component`

Update component metadata or status. Only provided fields are sent.

```lua
local component = statuspage_update_component({
  id = "component-test",
  status = "degraded_performance",
})
```

### `statuspage_delete_component`

Delete a component from the configured page.

```lua
local result = statuspage_delete_component({ id = "component-test" })
print(result.deleted)
```

## Return Shapes

Most tools return Statuspage API objects with fields such as `id`, `name`, `status`, `impact`, `created_at`, and `updated_at`. Delete tools return a small confirmation object:

```lua
{ deleted = true, id = "incident-test" }
```

## Multi-Account Usage

Use the namespace prefix assigned by the host:

```lua
local incidents = ns_statuspage_ops.statuspage_list_incidents({ limit = 5 })
```

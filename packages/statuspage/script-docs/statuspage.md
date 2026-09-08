# Atlassian Statuspage

Ruby API reference for the `statuspage` integration package. These tools use the Statuspage Manage API and require an API key plus a default `page_id`.

Use `statuspage_list_pages` first when you need to discover the correct page ID. Page-scoped tools then operate on the configured page unless a tool explicitly accepts `page_id`.

## Pages and User

### `statuspage_get_current_user`

Verify the API key and inspect the authenticated user.

```ruby
user = app.integrations.statuspage.get_current_user()
puts(user.email)
```
### `statuspage_list_pages`

List pages visible to the API key.

```ruby
pages = app.integrations.statuspage.list(per_page: 25)
pages.each do |page|
  puts(page.id, page.name)
end
```
### `statuspage_get_page`

Get details for the configured page or another visible page.

```ruby
page = app.integrations.statuspage.get()
puts(page.name)
other = app.integrations.statuspage.get(page_id: "page-test")
puts(other.id)
```
## Incidents

### `statuspage_list_incidents`

List incidents for the configured page. The Statuspage API may include resolved, active, and scheduled incidents.

```ruby
incidents = app.integrations.statuspage.list_incidents(limit: 10, page: 1)
incidents.each do |incident|
  puts(incident.id, incident.name, incident.status)
end
```
### `statuspage_list_unresolved_incidents`

List incidents that are still unresolved.

```ruby
open_incidents = app.integrations.statuspage.list_unresolved_incidents(limit: 10)
```
### `statuspage_list_upcoming_incidents`

List upcoming scheduled maintenance incidents.

```ruby
upcoming = app.integrations.statuspage.list_upcoming_incidents(limit: 10)
```
### `statuspage_create_incident`

Create a new incident or scheduled maintenance entry. `status` should match Statuspage values such as `investigating`, `identified`, `monitoring`, `resolved`, `scheduled`, `in_progress`, `verifying`, or `completed`.

```ruby
incident = app.integrations.statuspage.create_incident(name: "Example API latency", status: "investigating", impact: "minor", body: "We are investigating elevated latency.", component_ids: ["component-test"])
puts(incident.id)
```
For scheduled maintenance:

```ruby
maintenance = app.integrations.statuspage.create_incident(name: "Example database maintenance", status: "scheduled", impact: "none", body: "A maintenance window is scheduled.", scheduled_for: "2026-06-01T10:00:00Z", scheduled_until: "2026-06-01T11:00:00Z")
```
### `statuspage_update_incident`

Update only the fields you provide. To resolve a live incident, update `status` to `resolved`.

```ruby
updated = app.integrations.statuspage.update_incident(id: "incident-test", status: "monitoring", body: "Latency has returned to normal && we are monitoring.")
```
### `statuspage_delete_incident`

Delete an incident from the configured page. Prefer resolving real incidents instead of deleting them when preserving history matters.

```ruby
result = app.integrations.statuspage.delete_incident(id: "incident-test")
puts(result.deleted)
```
## Components

### `statuspage_list_components`

List components on the configured page.

```ruby
components = app.integrations.statuspage.list_components(per_page: 100)
components.each do |component|
  puts(component.id, component.name, component.status)
end
```
### `statuspage_get_component`

Get one component by ID.

```ruby
component = app.integrations.statuspage.get_component(id: "component-test")
puts(component.name)
```
### `statuspage_create_component`

Create a component. Supported statuses include `operational`, `degraded_performance`, `partial_outage`, `major_outage`, and `under_maintenance`.

```ruby
component = app.integrations.statuspage.create_component(name: "Example API", status: "operational", description: "Primary public API.")
puts(component.id)
```
### `statuspage_update_component`

Update component metadata or status. Only provided fields are sent.

```ruby
component = app.integrations.statuspage.update_component(id: "component-test", status: "degraded_performance")
```
### `statuspage_delete_component`

Delete a component from the configured page.

```ruby
result = app.integrations.statuspage.delete_component(id: "component-test")
puts(result.deleted)
```
## Return Shapes

Most tools return Statuspage API objects with fields such as `id`, `name`, `status`, `impact`, `created_at`, and `updated_at`. Delete tools return a small confirmation object:

```ruby
example = {deleted: true, id: "incident-test"}
```
## Multi-Account Usage

Use the namespace prefix assigned by the host:

```ruby
incidents = app.integrations.statuspage.ops.list_incidents(limit: 5)
```
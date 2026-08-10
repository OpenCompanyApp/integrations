# Onfleet — JavaScript API Reference

## list_tasks

List delivery tasks with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | integer | no | Task state: 0=unassigned, 1=assigned, 2=active, 3=completed |
| `worker` | string | no | Filter by worker ID |
| `organization` | string | no | Filter by organization ID |
| `team` | string | no | Filter by team ID |
| `completeBeforeAfter` | string | no | ISO 8601 — tasks completed after this time |
| `completeBeforeBefore` | string | no | ISO 8601 — tasks with completeBefore before this time |
| `from` | string | no | ISO 8601 — tasks created after this time |
| `to` | string | no | ISO 8601 — tasks created before this time |
| `lastUpdated` | string | no | ISO 8601 — tasks updated after this time |
| `query` | string | no | Search by recipient name, notes, or tracking URL |

### Task States

| Value | Description |
|-------|-------------|
| 0 | Unassigned |
| 1 | Assigned |
| 2 | Active (in-progress) |
| 3 | Completed |

### Examples

#### List all unassigned tasks

```js
var result = app.integrations.onfleet.list_tasks({
  state: 0,
})

for (const task of (result.tasks)) {
  console.log(task.id + ": " + task.destination.address.street)
}
```
#### List completed tasks for a worker

```js
var result = app.integrations.onfleet.list_tasks({
  state: 3,
  worker: "WORKER_ID",
})
```
#### List tasks created today

```js
var result = app.integrations.onfleet.list_tasks({
  from: "2026-04-05T00:00:00Z",
  to: "2026-04-05T23:59:59Z",
})
```
---

## get_task

Get detailed information about a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | The Onfleet task ID (24-char hex string) |

### Example

```js
var result = app.integrations.onfleet.get_task({
  task_id: "TASK_ID",
})

console.log("Status: " + result.state)
console.log("Destination: " + result.destination.address.street)
console.log("Recipient: " + result.recipients[0].name)
```
---

## create_task

Create a new delivery task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `destination_address` | string | yes | Destination street address |
| `recipient_name` | string | yes | Recipient full name |
| `recipient_phone` | string | no | Recipient phone (E.164 format) |
| `recipient_email` | string | no | Recipient email |
| `notes` | string | no | Driver notes |
| `complete_after` | string | no | ISO 8601 — earliest completion time |
| `complete_before` | string | no | ISO 8601 — latest completion deadline |
| `pickup_task` | boolean | no | True if this is a pickup (default: false) |
| `worker` | string | no | Worker ID to assign |
| `team` | string | no | Team ID to assign |
| `quantity` | integer | no | Number of units |
| `service_time` | integer | no | Estimated service time in seconds |

### Example

```js
var result = app.integrations.onfleet.create_task({
  destination_address: "123 Main St, San Francisco, CA 94105",
  recipient_name: "Jane Doe",
  recipient_phone: "+14155551234",
  notes: "Leave at front door",
  complete_before: "2026-04-05T18:00:00Z",
  team: "TEAM_ID",
})

console.log("Created task: " + result.task.id)
```
---

## update_task

Update an existing task. Only provided fields are changed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | Task ID to update |
| `destination_address` | string | no | New destination address |
| `notes` | string | no | Updated driver notes |
| `complete_after` | string | no | Updated earliest completion time (ISO 8601) |
| `complete_before` | string | no | Updated latest completion deadline (ISO 8601) |
| `worker` | string | no | New worker ID (empty to unassign) |
| `team` | string | no | New team ID |
| `quantity` | integer | no | Updated quantity |
| `service_time` | integer | no | Updated service time in seconds |

### Example

```js
var result = app.integrations.onfleet.update_task({
  task_id: "TASK_ID",
  notes: "Updated: ring doorbell twice",
  worker: "NEW_WORKER_ID",
})
```
---

## delete_task

Delete a task permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | Task ID to delete |

### Example

```js
var result = app.integrations.onfleet.delete_task({
  task_id: "TASK_ID",
})

console.log(result) // "Task 'TASK_ID' has been deleted."
```
---

## list_workers

List all workers (drivers).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `teams` | array | no | Array of team IDs to filter by |
| `states` | array | no | Worker states: 0=off-duty, 1=on-duty |
| `name` | string | no | Filter by name |
| `phone` | string | no | Filter by phone |
| `query` | string | no | General search query |

### Example

```js
var result = app.integrations.onfleet.list_workers({
  states: [0],
})

for (const worker of (result.workers)) {
  console.log(worker.name + " - " + (worker.vehicle && worker.vehicle.description || "no vehicle"))
}
```
---

## list_teams

List all teams in the organization.

### Parameters

None.

### Example

```js
var result = app.integrations.onfleet.list_teams()

for (const team of (result)) {
  console.log(team.name + " (" + team.workers.length + " workers)")
}
```
---

## list_recipients

List recipients (delivery customers).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter by name |
| `phone` | string | no | Filter by phone |
| `email` | string | no | Filter by email |
| `query` | string | no | General search query |

### Example

```js
var result = app.integrations.onfleet.list_recipients({
  name: "Jane",
})

for (const recipient of (result)) {
  console.log(recipient.name + " - " + (recipient.phone || "no phone"))
}
```
---

## get_current_user

Get the currently authenticated Onfleet user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.onfleet.get_current_user()

console.log("Logged in as: " + result.email)
console.log("Organization: " + result.organization)
```
---

## Multi-Account Usage

If you have multiple Onfleet accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.onfleet.list_tasks({state: 0})

// Explicit default (portable across setups)
app.integrations.onfleet.default.list_tasks({state: 0})

// Named accounts
app.integrations.onfleet.us_fleet.list_tasks({})
app.integrations.onfleet.eu_fleet.list_tasks({})
```
All functions are identical across accounts — only the credentials differ.

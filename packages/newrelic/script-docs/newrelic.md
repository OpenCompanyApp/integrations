# New Relic — JavaScript API Reference

## list_applications

List APM applications in the configured New Relic account.

### Parameters

None.

### Example

```js
var result = app.integrations.newrelic.list_applications({})

for (const app of (result)) {
  console.log(app.name + " (" + app.applicationId + ") - " + app.healthStatus)
}
```
---

## get_application

Get details of a specific APM application by its application ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_id` | integer | yes | The New Relic application ID |

### Example

```js
var result = app.integrations.newrelic.get_application({
  application_id: 12345678,
})

console.log("Name: " + result.name)
console.log("Language: " + result.language)
console.log("Health: " + result.healthStatus)
```
---

## list_deployments

List deployment markers for a New Relic APM application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_guid` | string | yes | The entity GUID of the application |

### Example

```js
var result = app.integrations.newrelic.list_deployments({
  application_guid: "MxJ9MxNNTU2NjIxFExWFxBfEFBVXxBYU",
})

for (const dep of (result)) {
  console.log(dep.revision + " by " + dep.user + " at " + dep.timestamp)
}
```
---

## create_deployment

Record a new deployment marker in New Relic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_guid` | string | yes | The entity GUID of the application |
| `revision` | string | yes | Deployment revision (e.g. commit SHA, version) |
| `description` | string | no | Description of the deployment |
| `user` | string | no | User who triggered the deployment |
| `changelog` | string | no | Changelog or commit message |

### Example

```js
var result = app.integrations.newrelic.create_deployment({
  application_guid: "MxJ9MxNNTU2NjIxFExWFxBfEFBVXxBYU",
  revision: "abc123def456",
  description: "Release v2.5.0",
  user: "deploy-bot",
  changelog: "feat: add user dashboard",
})

console.log("Deployment created: " + result.guid)
```
---

## list_alert_policies

List alert policies in the configured New Relic account.

### Parameters

None.

### Example

```js
var result = app.integrations.newrelic.list_alert_policies({})

for (const policy of (result)) {
  console.log(policy.name + " (ID: " + policy.id + ")")
}
```
---

## list_dashboards

List dashboards in the configured New Relic account.

### Parameters

None.

### Example

```js
var result = app.integrations.newrelic.list_dashboards({})

for (const dash of (result)) {
  console.log(dash.title + " - owner: " + (dash.owner.email || "unknown"))
}
```
---

## get_current_user

Get the profile of the currently authenticated New Relic user.

### Parameters

None.

### Example

```js
var result = app.integrations.newrelic.get_current_user({})
console.log("User: " + result.actor.user.name)
console.log("Email: " + result.actor.user.email)
```
---

## Multi-Account Usage

If you have multiple New Relic accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.newrelic.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.newrelic.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.newrelic.production.function_name({ /* parameters */ })
app.integrations.newrelic.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.

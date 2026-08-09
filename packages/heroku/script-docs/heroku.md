# Heroku — JavaScript API Reference

## list_apps

List all Heroku apps the authenticated user has access to.

### Parameters

None.

### Example

```js
var result = app.integrations.heroku.list_apps({})

for (const app of (result)) {
  console.log(app.name + " (" + app.region.name + ") - " + app.web_url)
}
```
---

## get_app

Get details for a specific Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name (e.g., `"my-app"` or the UUID) |

### Example

```js
var result = app.integrations.heroku.get_app({ app_id: "my-app" })
console.log(result.name + " - " + result.stack + " - " + result.git_url)
```
---

## list_dynos

List all dynos for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```js
var result = app.integrations.heroku.list_dynos({ app_id: "my-app" })

for (const dyno of (result)) {
  console.log(dyno.name + " (" + dyno.type + ") - " + dyno.state + " - size: " + dyno.size)
}
```
---

## list_addons

List all add-ons attached to a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```js
var result = app.integrations.heroku.list_addons({ app_id: "my-app" })

for (const addon of (result)) {
  console.log(addon.name + " (" + addon.plan.name + ") - " + addon.state)
}
```
---

## list_domains

List all domains for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```js
var result = app.integrations.heroku.list_domains({ app_id: "my-app" })

for (const domain of (result)) {
  console.log(domain.hostname + " (" + domain.kind + ") - " + domain.status)
}
```
---

## list_collaborators

List all collaborators for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```js
var result = app.integrations.heroku.list_collaborators({ app_id: "my-app" })

for (const collab of (result)) {
  console.log(collab.user.email + " - role: " + collab.role)
}
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```js
var result = app.integrations.heroku.get_current_user({})
console.log("Account: " + result.email + " - verified: " + String(result.verified))
```
---

## Multi-Account Usage

If you have multiple Heroku accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.heroku.list_apps({})

// Explicit default (portable across setups)
app.integrations.heroku.default.list_apps({})

// Named accounts
app.integrations.heroku.production.list_apps({})
app.integrations.heroku.staging.list_apps({})
```
All functions are identical across accounts — only the credentials differ.

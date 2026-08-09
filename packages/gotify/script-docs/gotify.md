# Gotify JavaScript API Reference

Namespace: `app.integrations.gotify`

Gotify has two token types:

- `app_token`: application token; can only send messages with `create_message`.
- `client_token`: client token; required for listing/deleting messages and managing applications, clients, or current user data.

The public `get_health` and `get_version` tools only need the Gotify server URL.

## Messages

### create_message

Send a notification through Gotify. Requires `app_token`.

Required: `message`

Optional: `title`, `priority`, `extras`

```js
var sent = app.integrations.gotify.create_message({
  title: "Deploy Complete",
  message: "Version 2.1.0 deployed successfully.",
  priority: 5,
})

console.log(sent.id)
```
Use `extras` for Gotify client display hints such as markdown rendering:

```js
app.integrations.gotify.create_message({
  title: "Weekly Report",
  message: "## Summary\n\n- Pageviews: 12450",
  extras: {
    ["client::display"]: {
      contentType: "text/markdown",
    },
  },
})
```
### list_messages

List messages visible to the configured `client_token`.

Optional: `limit` (default 100, max 200), `since`

Gotify's `since` parameter returns messages with an ID less than the supplied value.

```js
var result = app.integrations.gotify.list_messages({ limit: 25 })

for (const msg of (result.messages || [])) {
  console.log("[" + msg.id + "] " + msg.title)
}
```
### delete_message

Delete one message by ID. Requires `client_token`.

```js
app.integrations.gotify.delete_message({ id: 42 })
```
### delete_messages

Delete all messages visible to the configured `client_token`.

```js
app.integrations.gotify.delete_messages()
```
### list_application_messages

List messages sent by one application. Requires `client_token`.

Required: `application_id`

Optional: `limit`, `since`

```js
var result = app.integrations.gotify.list_application_messages({
  application_id: 7,
  limit: 50,
})
```
### delete_application_messages

Delete all messages sent by one application. Requires `client_token`.

```js
app.integrations.gotify.delete_application_messages({
  application_id: 7,
})
```
## Applications

### list_applications

List Gotify applications visible to the configured `client_token`.

```js
var apps = app.integrations.gotify.list_applications()
```
### create_application

Create a Gotify application and receive its generated application token. Requires `client_token`.

Required: `name`

Optional: `description`

```js
var app = app.integrations.gotify.create_application({
  name: "CI",
  description: "Build notifications",
})

console.log(app.token)
```
### update_application

Update an application name and description. Requires `client_token`.

```js
app.integrations.gotify.update_application({
  id: 7,
  name: "CI Alerts",
  description: "Build && deploy notifications",
})
```
### delete_application

Delete an application. Requires `client_token`; Gotify servers may also require elevated authentication for this endpoint.

```js
app.integrations.gotify.delete_application({ id: 7 })
```
## Clients

### list_clients

List Gotify clients visible to the configured `client_token`.

```js
var clients = app.integrations.gotify.list_clients()
```
### create_client

Create a Gotify client and receive its generated client token. Requires `client_token`.

```js
var client = app.integrations.gotify.create_client({
  name: "Automation",
})

console.log(client.token)
```
### update_client

Update a client name. Requires `client_token`.

```js
app.integrations.gotify.update_client({
  id: 12,
  name: "Automation Worker",
})
```
### delete_client

Delete a client. Requires `client_token`; Gotify servers may also require elevated authentication for this endpoint.

```js
app.integrations.gotify.delete_client({ id: 12 })
```
## Server And User

### get_health

Check Gotify server health.

```js
var health = app.integrations.gotify.get_health()
console.log(health.health)
```
### get_version

Get Gotify server version metadata.

```js
var version = app.integrations.gotify.get_version()
console.log(version.version)
```
### get_current_user

Get the current user for the configured `client_token`.

```js
var user = app.integrations.gotify.get_current_user()
console.log(user.name)
```
## Scope Notes

This package covers Gotify's core server-side REST API for messages, applications, clients, health, version, and current-user lookup. Browser OIDC flows, password changes, admin user management, plugin configuration, image upload, and websocket streaming are intentionally not exposed as ordinary request/response tools because they require browser sessions, elevated authentication, multipart file handling, plugin-specific schemas, or long-lived streaming behavior.

## Multi-Account Usage

```js
app.integrations.gotify.create_message({ message: "Default account" })
app.integrations.gotify.default.create_message({ message: "Explicit default" })
app.integrations.gotify.ops.create_message({ message: "Named account" })
```
All account namespaces expose the same functions. Only credentials and server URL change.

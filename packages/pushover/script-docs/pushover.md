# Pushover JavaScript API Reference

Namespace: `app.integrations.pushover`

Pushover tools use the configured application token plus a default user or delivery group key. Use fake or test-only message content when validating workflows; Pushover sends real notifications for write calls.

## Messages

### send_message

Send a Pushover message to the configured user/group key.

Required: `message`

Optional fields: `title`, `priority`, `url`, `url_title`, `sound`, `device`, `timestamp`, `expire`, `retry`, `callback`, `tags`, `ttl`, `html`, `monospace`, `attachment_base64`, `attachment_type`, `encrypted`.

Priority `2` is an emergency message and requires `retry` and `expire`. Emergency sends may return a `receipt`; use receipt tools to inspect or cancel retries.

```js
var result = app.integrations.pushover.send_message({
  title: "Example alert",
  message: "The example background job finished.",
  priority: 0,
  sound: "pushover",
})

console.log(result.request)
```
```js
var result = app.integrations.pushover.send_message({
  title: "Example incident",
  message: "Example service is unavailable.",
  priority: 2,
  retry: 60,
  expire: 3600,
  tags: "example-incident",
})

console.log(result.receipt)
```
### get_application_limits

Returns the application token's monthly message quota and reset information from Pushover.

```js
var limits = app.integrations.pushover.get_application_limits()
console.log(limits.limit)
console.log(limits.remaining)
console.log(limits.reset)
```
## Sounds And Validation

### list_sounds

List available sound names and display labels.

```js
var result = app.integrations.pushover.list_sounds()

for (const [name, label] of Object.entries(result.sounds)) {
  console.log(name + ": " + label)
}
```
### get_current_user

Validate the configured default user/group key and return `valid`, `devices`, `licenses`, and raw response details.

```js
var user = app.integrations.pushover.get_current_user()
console.log(user.valid)
```
### validate_user

Validate another user/group key or a specific device before sending.

```js
var result = app.integrations.pushover.validate_user({
  user_key: "u-example",
  device: "iphone",
})

console.log(result.valid)
```
## Emergency Receipts

### get_receipt

Get acknowledgement and retry state for an emergency message receipt.

```js
var receipt = app.integrations.pushover.get_receipt({
  receipt: "r-example",
})

console.log(receipt.acknowledged)
```
### cancel_receipt

Cancel retries for one active emergency receipt.

```js
app.integrations.pushover.cancel_receipt({
  receipt: "r-example",
})
```
### cancel_receipts_by_tag

Cancel retries for active emergency messages with a matching tag.

```js
app.integrations.pushover.cancel_receipts_by_tag({
  tag: "example-incident",
})
```
## Subscriptions

### migrate_subscription_user

Migrate a legacy collected user key to a subscription-scoped user key. Subscription creation and web subscription initiation happen in the Pushover dashboard/browser flow; this tool only covers the API-backed migration endpoint.

Required: `subscription`, `user_key`

Optional: `device_name`, `sound`

```js
var migrated = app.integrations.pushover.migrate_subscription_user({
  subscription: "Example-f504h08fhlasdfj",
  user_key: "u-example",
  sound: "pushover",
})

console.log(migrated.subscribed_user_key)
```
## Teams

Teams tools require the optional `team_token` credential. Pushover Teams API tokens are different from application API tokens.

### get_team

Show team metadata and users.

```js
var team = app.integrations.pushover.get_team()
console.log(team.name)
```
### add_team_user

Add a user to a team.

Required: `email`

Optional: `name`, `password`, `instant`, `admin`, `group`

```js
app.integrations.pushover.add_team_user({
  email: "person@example.test",
  name: "Example Person",
  instant: true,
  group: "Support",
})
```
### remove_team_user

Remove a user from a team by email address.

```js
app.integrations.pushover.remove_team_user({
  email: "person@example.test",
})
```
## Glances

### update_glance

Update Pushover glance/widget data for the configured user. At least one glance field is required.

```js
app.integrations.pushover.update_glance({
  title: "Queue",
  text: "Example jobs",
  count: 3,
  percent: 75,
})
```
## Delivery Groups

### create_group

Create a delivery group and return its group key.

```js
var group = app.integrations.pushover.create_group({
  name: "Example Operations",
})

console.log(group.group)
```
### list_groups

List delivery groups manageable by the application token.

```js
var groups = app.integrations.pushover.list_groups()
```
### get_group

Get group metadata and members.

```js
var group = app.integrations.pushover.get_group({
  group_key: "g-example",
})
```
### add_group_user

Add a user to a group. `device` and `memo` are optional.

```js
app.integrations.pushover.add_group_user({
  group_key: "g-example",
  user_key: "u-example",
  memo: "Example on-call user",
})
```
### remove_group_user

Remove a user or device-specific membership from a group.

```js
app.integrations.pushover.remove_group_user({
  group_key: "g-example",
  user_key: "u-example",
})
```
### disable_group_user

Temporarily disable a group member without removing it.

```js
app.integrations.pushover.disable_group_user({
  group_key: "g-example",
  user_key: "u-example",
})
```
### enable_group_user

Re-enable a disabled group member.

```js
app.integrations.pushover.enable_group_user({
  group_key: "g-example",
  user_key: "u-example",
})
```
### rename_group

Rename a delivery group.

```js
app.integrations.pushover.rename_group({
  group_key: "g-example",
  name: "Example Support",
})
```
## Licenses

### get_license_credits

Return remaining prepaid Pushover license credits.

```js
var credits = app.integrations.pushover.get_license_credits()
console.log(credits.credits)
```
### assign_license

Assign a prepaid license to an existing user key or email address. Provide either `user_key` or `email`; `os` is optional when the Pushover account can infer the target platform.

```js
app.integrations.pushover.assign_license({
  email: "person@example.test",
  os: "Android",
})
```
## Multi-Account Usage

```js
app.integrations.pushover.send_message({ message: "Default account" })
app.integrations.pushover.default.send_message({ message: "Explicit default" })
app.integrations.pushover.operations.send_message({ message: "Named account" })
```
All account namespaces expose the same functions. Only credentials change.

## Scope Notes

This package covers the server-side Pushover application, groups, glances, licensing, subscriptions migration, and Teams API endpoints. The Pushover Open Client API is intentionally not exposed here because it requires end-user email/password login, device registration, local session secrets, and websocket client behavior rather than a server-side application token integration.

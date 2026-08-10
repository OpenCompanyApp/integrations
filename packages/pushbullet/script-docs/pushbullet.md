# Pushbullet

JavaScript API reference for the `pushbullet` integration package. The integration uses Pushbullet access tokens and the official `Access-Token` header.

Most list tools accept `limit`, `cursor`, `active`, and `modified_after`, matching Pushbullet's list-object pagination and sync model.

## User

### `pushbullet_get_current_user`

```js
var user = pushbullet_get_current_user()
console.log(user.name, user.email)
```
## Pushes

### `pushbullet_list_pushes`

```js
var result = pushbullet_list_pushes({ limit: 25, active: true })
for (const push of (result.pushes)) {
  console.log(push.iden, push.type, push.title)
}
```
### `pushbullet_create_push`

Create a note, link, or file push.

```js
var note = pushbullet_create_push({
  type: "note",
  title: "Build complete",
  body: "The deployment finished.",
})

var link = pushbullet_create_push({
  type: "link",
  title: "Report",
  body: "Monthly report is ready.",
  url: "https://example.test/reports/monthly",
})
```
For file pushes, first call `pushbullet_request_upload`, upload the file to the returned `upload_url`, then send a file push using the returned `file_name`, `file_type`, and `file_url`.

```js
var upload = pushbullet_request_upload({
  file_name: "report.pdf",
  file_type: "application/pdf",
})

var file_push = pushbullet_create_push({
  type: "file",
  title: "Report",
  body: "PDF attached.",
  file_name: upload.file_name,
  file_type: upload.file_type,
  file_url: upload.file_url,
})
```
### `pushbullet_update_push`

```js
var push = pushbullet_update_push({
  push_iden: "push-test",
  dismissed: true,
})
```
### `pushbullet_delete_push`

```js
var result = pushbullet_delete_push({ push_iden: "push-test" })
console.log(result.deleted)
```
### `pushbullet_delete_all_pushes`

Deletes all pushes asynchronously.

```js
var result = pushbullet_delete_all_pushes()
```
## Devices

### `pushbullet_list_devices`

```js
var result = pushbullet_list_devices({ active: true })
for (const device of (result.devices)) {
  console.log(device.iden, device.nickname, device.icon)
}
```
### `pushbullet_create_device`

```js
var device = pushbullet_create_device({
  nickname: "Ops Console",
  icon: "desktop",
  model: "Example Terminal",
})
```
### `pushbullet_update_device`

```js
var device = pushbullet_update_device({
  device_iden: "device-test",
  nickname: "Ops Console 2",
})
```
### `pushbullet_delete_device`

```js
var result = pushbullet_delete_device({ device_iden: "device-test" })
```
## Chats

### `pushbullet_list_chats`

```js
var chats = pushbullet_list_chats({ limit: 10 })
```
### `pushbullet_create_chat`

```js
var chat = pushbullet_create_chat({ email: "person@example.test" })
```
### `pushbullet_update_chat`

```js
var chat = pushbullet_update_chat({
  chat_iden: "chat-test",
  muted: true,
})
```
### `pushbullet_delete_chat`

```js
var result = pushbullet_delete_chat({ chat_iden: "chat-test" })
```
## Subscriptions and Channels

### `pushbullet_list_subscriptions`

```js
var subscriptions = pushbullet_list_subscriptions({ active: true })
```
### `pushbullet_create_subscription`

```js
var subscription = pushbullet_create_subscription({
  channel_tag: "example-channel",
})
```
### `pushbullet_update_subscription`

```js
var subscription = pushbullet_update_subscription({
  subscription_iden: "subscription-test",
  muted: true,
})
```
### `pushbullet_delete_subscription`

```js
var result = pushbullet_delete_subscription({
  subscription_iden: "subscription-test",
})
```
### `pushbullet_get_channel_info`

```js
var channel = pushbullet_get_channel_info({
  tag: "example-channel",
  no_recent_pushes: true,
})
```
### `pushbullet_create_channel`

```js
var channel = pushbullet_create_channel({
  tag: "example-channel",
  name: "Example Channel",
  description: "Example alerts.",
  website_url: "https://example.test",
})
```
## Ephemerals

### `pushbullet_push_ephemeral`

Use ephemerals for realtime events such as clipboard updates or notification dismissals.

```js
var result = pushbullet_push_ephemeral({
  type: "push",
  push: {
    type: "clip",
    body: "https://example.test",
    source_user_iden: "user-test",
  },
})
```
## Uploads

### `pushbullet_request_upload`

```js
var upload = pushbullet_request_upload({
  file_name: "report.pdf",
  file_type: "application/pdf",
})
console.log(upload.upload_url, upload.file_url)
```
## Return Shapes

Pushbullet returns top-level collections such as `pushes`, `devices`, `chats`, and `subscriptions`. Delete tools return compact confirmation objects:

```js
const example = { deleted: true, push_iden: "push-test" }
```
## Multi-Account Usage

Use the namespace prefix assigned by the host:

```js
var pushes = ns_pushbullet_ops.pushbullet_list_pushes({ limit: 5 })
```
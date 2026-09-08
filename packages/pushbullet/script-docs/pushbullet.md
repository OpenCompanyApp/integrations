# Pushbullet

Ruby API reference for the `pushbullet` integration package. The integration uses Pushbullet access tokens and the official `Access-Token` header.

Most list tools accept `limit`, `cursor`, `active`, and `modified_after`, matching Pushbullet's list-object pagination and sync model.

## User

### `pushbullet_get_current_user`

```ruby
user = app.integrations.pushbullet.get_current_user()
puts(user.name, user.email)
```
## Pushes

### `pushbullet_list_pushes`

```ruby
result = app.integrations.pushbullet.list_pushes(limit: 25, active: true)
result.pushes.each do |push|
  puts(push.iden, push.type, push.title)
end
```
### `pushbullet_create_push`

Create a note, link, or file push.

```ruby
note = app.integrations.pushbullet.create(type: "note", title: "Build complete", body: "The deployment finished.")
link = app.integrations.pushbullet.create(type: "link", title: "Report", body: "Monthly report is ready.", url: "https://example.test/reports/monthly")
```
For file pushes, first call `pushbullet_request_upload`, upload the file to the returned `upload_url`, then send a file push using the returned `file_name`, `file_type`, and `file_url`.

```ruby
upload = app.integrations.pushbullet.request_upload(file_name: "report.pdf", file_type: "application/pdf")
file_push = app.integrations.pushbullet.create(type: "file", title: "Report", body: "PDF attached.", file_name: upload.file_name, file_type: upload.file_type, file_url: upload.file_url)
```
### `pushbullet_update_push`

```ruby
push = app.integrations.pushbullet.update(push_iden: "push-test", dismissed: true)
```
### `pushbullet_delete_push`

```ruby
result = app.integrations.pushbullet.delete(push_iden: "push-test")
puts(result.deleted)
```
### `pushbullet_delete_all_pushes`

Deletes all pushes asynchronously.

```ruby
result = app.integrations.pushbullet.delete_all_pushes()
```
## Devices

### `pushbullet_list_devices`

```ruby
result = app.integrations.pushbullet.list_devices(active: true)
result.devices.each do |device|
  puts(device.iden, device.nickname, device.icon)
end
```
### `pushbullet_create_device`

```ruby
device = app.integrations.pushbullet.create_device(nickname: "Ops Console", icon: "desktop", model: "Example Terminal")
```
### `pushbullet_update_device`

```ruby
device = app.integrations.pushbullet.update_device(device_iden: "device-test", nickname: "Ops Console 2")
```
### `pushbullet_delete_device`

```ruby
result = app.integrations.pushbullet.delete_device(device_iden: "device-test")
```
## Chats

### `pushbullet_list_chats`

```ruby
chats = app.integrations.pushbullet.list_chats(limit: 10)
```
### `pushbullet_create_chat`

```ruby
chat = app.integrations.pushbullet.create_chat(email: "person@example.test")
```
### `pushbullet_update_chat`

```ruby
chat = app.integrations.pushbullet.update_chat(chat_iden: "chat-test", muted: true)
```
### `pushbullet_delete_chat`

```ruby
result = app.integrations.pushbullet.delete_chat(chat_iden: "chat-test")
```
## Subscriptions and Channels

### `pushbullet_list_subscriptions`

```ruby
subscriptions = app.integrations.pushbullet.list_subscriptions(active: true)
```
### `pushbullet_create_subscription`

```ruby
subscription = app.integrations.pushbullet.create_subscription(channel_tag: "example-channel")
```
### `pushbullet_update_subscription`

```ruby
subscription = app.integrations.pushbullet.update_subscription(subscription_iden: "subscription-test", muted: true)
```
### `pushbullet_delete_subscription`

```ruby
result = app.integrations.pushbullet.delete_subscription(subscription_iden: "subscription-test")
```
### `pushbullet_get_channel_info`

```ruby
channel = app.integrations.pushbullet.get_channel_info(tag: "example-channel", no_recent_pushes: true)
```
### `pushbullet_create_channel`

```ruby
channel = app.integrations.pushbullet.create_channel(tag: "example-channel", name: "Example Channel", description: "Example alerts.", website_url: "https://example.test")
```
## Ephemerals

### `pushbullet_push_ephemeral`

Use ephemerals for realtime events such as clipboard updates or notification dismissals.

```ruby
result = app.integrations.pushbullet.ephemeral(type: "push", push: {type: "clip", body: "https://example.test", source_user_iden: "user-test"})
```
## Uploads

### `pushbullet_request_upload`

```ruby
upload = app.integrations.pushbullet.request_upload(file_name: "report.pdf", file_type: "application/pdf")
puts(upload.upload_url, upload.file_url)
```
## Return Shapes

Pushbullet returns top-level collections such as `pushes`, `devices`, `chats`, and `subscriptions`. Delete tools return compact confirmation objects:

```ruby
example = {deleted: true, push_iden: "push-test"}
```
## Multi-Account Usage

Use the namespace prefix assigned by the host:

```ruby
pushes = app.integrations.pushbullet.ops.list_pushes(limit: 5)
```
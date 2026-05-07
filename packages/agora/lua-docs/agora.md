# Agora Cloud Recording — Lua API Supplement

The Agora integration exposes the documented Cloud Recording RESTful API. Use it to acquire a recording resource, start a recording session, query status, update subscriptions or layouts, stop the session, and maintain notification-service firewall allowlists.

Agora uses Basic REST authentication with a customer ID and customer secret plus an App ID with Cloud Recording enabled.

## Recording Workflow

Cloud Recording is a stateful workflow:

1. `acquire_recording_resource`
2. `start_recording`
3. `query_recording` while active
4. `update_recording` or `update_recording_layout` when needed
5. `stop_recording`

The `resource_id` from acquire is single-use. The `sid` from start identifies the active recording session.

## acquire_recording_resource

Request a resource ID for one recording session.

```lua
local acquired = app.integrations.agora.acquire_recording_resource({
  cname = "team-standup",
  uid = "527841",
  scene = 0,
  resource_expired_hour = 24,
})

local resource_id = acquired.resourceId
```

The `uid` must be unique inside the channel and must be reused in start and stop calls.

## start_recording

Start individual, composite, or web page recording. `mode` is `individual`, `mix`, or `web`.

```lua
local started = app.integrations.agora.start_recording({
  resource_id = resource_id,
  mode = "mix",
  cname = "team-standup",
  uid = "527841",
  recording_config = {
    channelType = 1,
    streamTypes = 2,
    maxIdleTime = 30,
  },
  recording_file_config = {
    avFileType = { "hls" },
  },
  storage_config = {
    vendor = 1,
    region = 0,
    bucket = "recordings-example",
    accessKey = "fake-access-key",
    secretKey = "fake-secret-key",
    fileNamePrefix = { "agora", "team-standup" },
  },
})

local sid = started.sid
```

Storage credentials are sent directly to Agora. Use fake values in tests and docs, never real bucket credentials.

## query_recording

Check whether a session is active and inspect file or extension service state.

```lua
local status = app.integrations.agora.query_recording({
  resource_id = resource_id,
  sid = sid,
  mode = "mix",
})

print(status.serverResponse.status)
```

Agora's `serverResponse` differs by mode and configuration. Composite recordings can return `fileListMode`, `fileList`, and `uploadingStatus`; web recordings can return extension service state.

## update_recording

Update subscription lists or web recording extension state while a session is active.

```lua
app.integrations.agora.update_recording({
  resource_id = resource_id,
  sid = sid,
  mode = "mix",
  cname = "team-standup",
  uid = "527841",
  stream_subscribe = {
    audioUidList = {
      subscribeAudioUids = { "123", "456" },
    },
    videoUidList = {
      subscribeVideoUids = { "123" },
    },
  },
})
```

For newer Agora fields not yet promoted to first-class parameters, pass the documented `client_request` object directly. The tool still adds credentials and wraps it correctly.

## update_recording_layout

Update the mixed video layout for composite recordings.

```lua
app.integrations.agora.update_recording_layout({
  resource_id = resource_id,
  sid = sid,
  cname = "team-standup",
  uid = "527841",
  mixed_video_layout = 3,
  background_color = "#000000",
  layout_config = {
    { uid = "123", x_axis = 0, y_axis = 0, width = 0.5, height = 1, alpha = 1 },
    { uid = "456", x_axis = 0.5, y_axis = 0, width = 0.5, height = 1, alpha = 1 },
  },
})
```

This tool always calls Agora's `mode/mix/updateLayout` endpoint.

## stop_recording

Stop the active session. After stop, acquire a new resource before recording again.

```lua
local stopped = app.integrations.agora.stop_recording({
  resource_id = resource_id,
  sid = sid,
  mode = "mix",
  cname = "team-standup",
  uid = "527841",
  async_stop = false,
})

print(stopped.serverResponse.uploadingStatus)
```

If `async_stop` is true, Agora returns before all files finish uploading.

## get_notification_ips

Fetch message notification service IP addresses for firewall allowlists.

```lua
local ips = app.integrations.agora.get_notification_ips({})

for _, host in ipairs(ips.data.service.hosts) do
  print(host.primaryIP)
end
```

Agora recommends keeping this allowlist current because the notification service IPs can change.

## Multi-Account Usage

If multiple Agora accounts are configured, use account-specific namespaces:

```lua
app.integrations.agora.acquire_recording_resource({...})
app.integrations.agora.default.acquire_recording_resource({...})
app.integrations.agora.production.acquire_recording_resource({...})
```

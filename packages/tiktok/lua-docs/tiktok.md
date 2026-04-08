# TikTok — Lua API Reference

## list_videos

List videos available for an advertiser in TikTok Business.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `advertiser_id` | string | yes | The TikTok advertiser ID. |
| `page` | integer | no | Page number for pagination. Defaults to 1. |
| `page_size` | integer | no | Number of videos per page. Defaults to 10. |

### Example

```lua
local result = app.integrations.tiktok.list_videos({
  advertiser_id = "123456789",
  page_size = 20
})

for _, video in ipairs(result.data.list) do
  print(video.video_name .. " (ID: " .. video.video_id .. ")")
end
```

---

## get_video

Get details for a specific TikTok video, including preview URL, duration, and status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `advertiser_id` | string | yes | The TikTok advertiser ID. |
| `video_id` | string | yes | The TikTok video ID. |

### Example

```lua
local result = app.integrations.tiktok.get_video({
  advertiser_id = "123456789",
  video_id = "v001"
})

print(result.data.video_name)
print("Duration: " .. result.data.duration .. "s")
print("Preview: " .. result.data.preview_url)
```

---

## upload_video

Upload a video to TikTok via URL for use in advertising campaigns.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `advertiser_id` | string | yes | The TikTok advertiser ID. |
| `video_url` | string | yes | URL of the video to upload (must be publicly accessible). |
| `file_name` | string | no | Custom name for the uploaded video file. |

### Example

```lua
local result = app.integrations.tiktok.upload_video({
  advertiser_id = "123456789",
  video_url = "https://example.com/videos/ad-creative.mp4",
  file_name = "summer-campaign-creative"
})

print("Uploaded video ID: " .. result.video_id)
```

---

## list_campaigns

List advertising campaigns for a TikTok advertiser.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `advertiser_id` | string | yes | The TikTok advertiser ID. |
| `page` | integer | no | Page number for pagination. Defaults to 1. |
| `page_size` | integer | no | Number of campaigns per page. Defaults to 10. |

### Example

```lua
local result = app.integrations.tiktok.list_campaigns({
  advertiser_id = "123456789",
  page_size = 20
})

for _, campaign in ipairs(result.data.list) do
  print(campaign.campaign_name .. " — Status: " .. campaign.status)
end
```

---

## get_campaign

Get details for a specific TikTok advertising campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `advertiser_id` | string | yes | The TikTok advertiser ID. |
| `campaign_id` | string | yes | The TikTok campaign ID. |

### Example

```lua
local result = app.integrations.tiktok.get_campaign({
  advertiser_id = "123456789",
  campaign_id = "c001"
})

local campaign = result.data.list[1]
print(campaign.campaign_name)
print("Budget: " .. campaign.budget)
print("Status: " .. campaign.status)
```

---

## list_advertisers

List advertisers accessible to the authenticated TikTok Business user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | no | TikTok app ID to filter advertisers. |
| `secret` | string | no | TikTok app secret to filter advertisers. |

### Example

```lua
local result = app.integrations.tiktok.list_advertisers({})

for _, adv in ipairs(result.data.list) do
  print(adv.advertiser_id .. " — " .. adv.name)
end
```

---

## get_current_user

Get the authenticated user's TikTok Business account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.tiktok.get_current_user({})

print("Authenticated as: " .. result.data.display_name)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple TikTok accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.tiktok.list_advertisers({})

-- Explicit default (portable across setups)
app.integrations.tiktok.default.list_advertisers({})

-- Named accounts
app.integrations.tiktok.work.list_campaigns({
  advertiser_id = "123456789"
})
app.integrations.tiktok.brand_account.list_videos({
  advertiser_id = "987654321"
})
```

All functions are identical across accounts — only the credentials differ.

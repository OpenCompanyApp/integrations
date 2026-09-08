# TikTok — Ruby API Reference

## list_videos

List videos available for an advertiser in TikTok Business.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `advertiser_id` | string | yes | The TikTok advertiser ID. |
| `page` | integer | no | Page number for pagination. Defaults to 1. |
| `page_size` | integer | no | Number of videos per page. Defaults to 10. |

### Example

```ruby
result = app.integrations.tiktok.list_videos(advertiser_id: "123456789", page_size: 20)
result.data.list.each do |video|
  puts((video.video_name).to_s + " (ID: " + (video.video_id).to_s + ")")
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

```ruby
result = app.integrations.tiktok.get_video(advertiser_id: "123456789", video_id: "v001")
puts(result.data.video_name)
puts("Duration: " + (result.data.duration).to_s + "s")
puts("Preview: " + (result.data.preview_url).to_s)
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

```ruby
result = app.integrations.tiktok.upload_video(advertiser_id: "123456789", video_url: "https://example.com/videos/ad-creative.mp4", file_name: "summer-campaign-creative")
puts("Uploaded video ID: " + (result.video_id).to_s)
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

```ruby
result = app.integrations.tiktok.list_campaigns(advertiser_id: "123456789", page_size: 20)
result.data.list.each do |campaign|
  puts((campaign.campaign_name).to_s + " — Status: " + (campaign.status).to_s)
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

```ruby
result = app.integrations.tiktok.get_campaign(advertiser_id: "123456789", campaign_id: "c001")
campaign = result.data.list[0]
puts(campaign.campaign_name)
puts("Budget: " + (campaign.budget).to_s)
puts("Status: " + (campaign.status).to_s)
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

```ruby
result = app.integrations.tiktok.list_advertisers()
result.data.list.each do |adv|
  puts((adv.advertiser_id).to_s + " — " + (adv.name).to_s)
end
```
---

## get_current_user

Get the authenticated user's TikTok Business account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.tiktok.get_current_user()
puts("Authenticated as: " + (result.data.display_name).to_s)
puts("Email: " + (result.data.email).to_s)
```
---

## Multi-Account Usage

If you have multiple TikTok accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.tiktok.list_advertisers()
# Explicit default (portable across setups)
app.integrations.tiktok.default.list_advertisers()
# Named accounts
app.integrations.tiktok.work.list_campaigns(advertiser_id: "123456789")
app.integrations.tiktok.brand_account.list_videos(advertiser_id: "987654321")
```
All functions are identical across accounts — only the credentials differ.

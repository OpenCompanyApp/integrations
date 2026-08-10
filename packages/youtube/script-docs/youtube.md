# YouTube

YouTube tools are exposed under `app.integrations.youtube`. This package is generated from Google's official YouTube Data API v3 Discovery document and exposes 83 REST methods.

## Coverage

- Source: `https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest`
- Read tools: 28
- Write tools: 55
- Media upload tools: 8
- Base URL: `https://youtube.googleapis.com`

## Usage Notes

Public read operations can use `api_key`; private, write, moderation, live, caption, and upload operations require an OAuth access token with the YouTube scopes documented by Google. Query parameters can be passed as top-level shortcuts or inside `query`. Request bodies go inside `body`. Upload endpoints accept `file_path`, optional `mime_type`, and optional metadata in `body`; the integration sends multipart upload requests with `uploadType=multipart`.

The YouTube API uses quota costs and many methods require `part`; pass `part` exactly as documented, often as a comma-separated string such as `snippet,contentDetails`.

## Tools

- `youtube_video_trainability_get` - GET /youtube/v3/videoTrainability
- `youtube_live_chat_moderators_list` - GET /youtube/v3/liveChat/moderators
- `youtube_live_chat_moderators_delete` - DELETE /youtube/v3/liveChat/moderators
- `youtube_live_chat_moderators_insert` - POST /youtube/v3/liveChat/moderators
- `youtube_channel_sections_insert` - POST /youtube/v3/channelSections
- `youtube_channel_sections_update` - PUT /youtube/v3/channelSections
- `youtube_channel_sections_list` - GET /youtube/v3/channelSections
- `youtube_channel_sections_delete` - DELETE /youtube/v3/channelSections
- `youtube_live_chat_messages_transition` - POST /youtube/v3/liveChat/messages/transition
- `youtube_live_chat_messages_list` - GET /youtube/v3/liveChat/messages
- `youtube_live_chat_messages_delete` - DELETE /youtube/v3/liveChat/messages
- `youtube_live_chat_messages_insert` - POST /youtube/v3/liveChat/messages
- `youtube_search_list` - GET /youtube/v3/search
- `youtube_channel_banners_insert` - POST /youtube/v3/channelBanners/insert (media upload)
- `youtube_comments_insert` - POST /youtube/v3/comments
- `youtube_comments_mark_as_spam` - POST /youtube/v3/comments/markAsSpam
- `youtube_comments_list` - GET /youtube/v3/comments
- `youtube_comments_delete` - DELETE /youtube/v3/comments
- `youtube_comments_set_moderation_status` - POST /youtube/v3/comments/setModerationStatus
- `youtube_comments_update` - PUT /youtube/v3/comments
- `youtube_video_categories_list` - GET /youtube/v3/videoCategories
- `youtube_i18n_regions_list` - GET /youtube/v3/i18nRegions
- `youtube_playlist_images_list` - GET /youtube/v3/playlistImages
- `youtube_playlist_images_delete` - DELETE /youtube/v3/playlistImages
- `youtube_playlist_images_insert` - POST /youtube/v3/playlistImages (media upload)
- `youtube_playlist_images_update` - PUT /youtube/v3/playlistImages (media upload)
- `youtube_super_chat_events_list` - GET /youtube/v3/superChatEvents
- `youtube_members_list` - GET /youtube/v3/members
- `youtube_videos_rate` - POST /youtube/v3/videos/rate
- `youtube_videos_insert` - POST /youtube/v3/videos (media upload)
- `youtube_videos_list` - GET /youtube/v3/videos
- `youtube_videos_delete` - DELETE /youtube/v3/videos
- `youtube_videos_get_rating` - GET /youtube/v3/videos/getRating
- `youtube_videos_update` - PUT /youtube/v3/videos
- `youtube_videos_report_abuse` - POST /youtube/v3/videos/reportAbuse
- `youtube_playlist_items_insert` - POST /youtube/v3/playlistItems
- `youtube_playlist_items_update` - PUT /youtube/v3/playlistItems
- `youtube_playlist_items_list` - GET /youtube/v3/playlistItems
- `youtube_playlist_items_delete` - DELETE /youtube/v3/playlistItems
- `youtube_abuse_reports_insert` - POST /youtube/v3/abuseReports
- `youtube_youtube_v3_update_comment_threads` - PUT /youtube/v3/commentThreads
- `youtube_youtube_v3_live_chat_messages_stream` - GET /youtube/v3/liveChat/messages/stream
- `youtube_tests_insert` - POST /youtube/v3/tests
- `youtube_watermarks_set` - POST /youtube/v3/watermarks/set (media upload)
- `youtube_watermarks_unset` - POST /youtube/v3/watermarks/unset
- `youtube_live_broadcasts_transition` - POST /youtube/v3/liveBroadcasts/transition
- `youtube_live_broadcasts_insert_cuepoint` - POST /youtube/v3/liveBroadcasts/cuepoint
- `youtube_live_broadcasts_insert` - POST /youtube/v3/liveBroadcasts
- `youtube_live_broadcasts_bind` - POST /youtube/v3/liveBroadcasts/bind
- `youtube_live_broadcasts_list` - GET /youtube/v3/liveBroadcasts
- `youtube_live_broadcasts_delete` - DELETE /youtube/v3/liveBroadcasts
- `youtube_live_broadcasts_update` - PUT /youtube/v3/liveBroadcasts
- `youtube_channels_update` - PUT /youtube/v3/channels
- `youtube_channels_list` - GET /youtube/v3/channels
- `youtube_memberships_levels_list` - GET /youtube/v3/membershipsLevels
- `youtube_i18n_languages_list` - GET /youtube/v3/i18nLanguages
- `youtube_video_abuse_report_reasons_list` - GET /youtube/v3/videoAbuseReportReasons
- `youtube_playlists_list` - GET /youtube/v3/playlists
- `youtube_playlists_delete` - DELETE /youtube/v3/playlists
- `youtube_playlists_insert` - POST /youtube/v3/playlists
- `youtube_playlists_update` - PUT /youtube/v3/playlists
- `youtube_subscriptions_list` - GET /youtube/v3/subscriptions
- `youtube_subscriptions_delete` - DELETE /youtube/v3/subscriptions
- `youtube_subscriptions_insert` - POST /youtube/v3/subscriptions
- `youtube_live_chat_bans_insert` - POST /youtube/v3/liveChat/bans
- `youtube_live_chat_bans_delete` - DELETE /youtube/v3/liveChat/bans
- `youtube_thumbnails_set` - POST /youtube/v3/thumbnails/set (media upload)
- `youtube_captions_insert` - POST /youtube/v3/captions (media upload)
- `youtube_captions_update` - PUT /youtube/v3/captions (media upload)
- `youtube_captions_list` - GET /youtube/v3/captions
- `youtube_captions_delete` - DELETE /youtube/v3/captions
- `youtube_captions_download` - GET /youtube/v3/captions/{id}
- `youtube_live_streams_insert` - POST /youtube/v3/liveStreams
- `youtube_live_streams_update` - PUT /youtube/v3/liveStreams
- `youtube_live_streams_list` - GET /youtube/v3/liveStreams
- `youtube_live_streams_delete` - DELETE /youtube/v3/liveStreams
- `youtube_comment_threads_list` - GET /youtube/v3/commentThreads
- `youtube_comment_threads_insert` - POST /youtube/v3/commentThreads
- `youtube_third_party_links_insert` - POST /youtube/v3/thirdPartyLinks
- `youtube_third_party_links_update` - PUT /youtube/v3/thirdPartyLinks
- `youtube_third_party_links_list` - GET /youtube/v3/thirdPartyLinks
- `youtube_third_party_links_delete` - DELETE /youtube/v3/thirdPartyLinks
- `youtube_activities_list` - GET /youtube/v3/activities

## Examples

```js
var videos = app.integrations.youtube.youtube_videos_list({ part: "snippet,statistics", id: "dQw4w9WgXcQ" })

var search = app.integrations.youtube.youtube_search_list({ part: "snippet", q: "open source laravel", maxResults: 5 })
```
Responses are decoded YouTube Data API JSON responses, or `{ success = true, status = ... }` for successful empty responses.

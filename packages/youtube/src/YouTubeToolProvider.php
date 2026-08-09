<?php

namespace OpenCompany\Integrations\YouTube;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for YouTube.
 *
 * Exposes generated coverage for the official YouTube Data API v3 Discovery
 * document, including videos, playlists, comments, captions, and live APIs.
 */
class YouTubeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token_or_api_key','legacy_auth_type'=>'oauth_or_api_key','credential_mode'=>'stored_token_or_secret','setup_flows'=>['manual_token','manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Public read operations can use an API key. Private, write, and upload operations require a YouTube OAuth access token with the appropriate scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token_or_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token_or_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'youtube'; }
    public function appMeta(): array { return ['label'=>'YouTube','description'=>'Videos, channels, playlists, comments, captions, live chat, broadcasts, search, and uploads','icon'=>'ph:youtube-logo','logo'=>'logos:youtube-icon']; }
    public function integrationMeta(): array { return ['name'=>'YouTube','description'=>'Generated coverage for the YouTube Data API v3: videos, channels, playlists, comments, captions, live chat, live broadcasts, subscriptions, search, and media uploads.','icon'=>'ph:youtube-logo','logo'=>'logos:youtube-icon','category'=>'data','badge'=>'verified','docs_url'=>'https://developers.google.com/youtube/v3/docs']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'OAuth Access Token','placeholder'=>'YouTube OAuth access token','hint'=>'Required for private, write, and upload operations.','required'=>false], ['key'=>'api_key','type'=>'secret','label'=>'API Key','placeholder'=>'YouTube Data API key','hint'=>'Enough for many public read operations.','required'=>false], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://youtube.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://youtube.googleapis.com']]; }
    /**
     * Verify YouTube credentials with token or API-key presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { if((string)($config['access_token']??'')==='' && (string)($config['api_key']??'')==='') return ['success'=>false,'error'=>'Provide either an OAuth access token or API key.']; return ['success'=>true,'message'=>'YouTube credentials are present. Use a read tool such as youtube_channels_list for a live check.']; }
    public function validationRules(): array { return ['access_token'=>'nullable|string','api_key'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'youtube_video_trainability_get' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideoTrainabilityGet',
  'type' => 'read',
  'name' => 'Video Trainability Get',
  'description' => 'Video Trainability Get (GET /youtube/v3/videoTrainability).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_live_chat_moderators_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatModeratorsList',
  'type' => 'read',
  'name' => 'Live Chat Moderators List',
  'description' => 'Live Chat Moderators List (GET /youtube/v3/liveChat/moderators).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_live_chat_moderators_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatModeratorsDelete',
  'type' => 'write',
  'name' => 'Live Chat Moderators Delete',
  'description' => 'Live Chat Moderators Delete (DELETE /youtube/v3/liveChat/moderators).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_chat_moderators_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatModeratorsInsert',
  'type' => 'write',
  'name' => 'Live Chat Moderators Insert',
  'description' => 'Live Chat Moderators Insert (POST /youtube/v3/liveChat/moderators).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_channel_sections_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelSectionsInsert',
  'type' => 'write',
  'name' => 'Channel Sections Insert',
  'description' => 'Channel Sections Insert (POST /youtube/v3/channelSections).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_channel_sections_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelSectionsUpdate',
  'type' => 'write',
  'name' => 'Channel Sections Update',
  'description' => 'Channel Sections Update (PUT /youtube/v3/channelSections).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_channel_sections_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelSectionsList',
  'type' => 'read',
  'name' => 'Channel Sections List',
  'description' => 'Channel Sections List (GET /youtube/v3/channelSections).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_channel_sections_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelSectionsDelete',
  'type' => 'write',
  'name' => 'Channel Sections Delete',
  'description' => 'Channel Sections Delete (DELETE /youtube/v3/channelSections).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_chat_messages_transition' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatMessagesTransition',
  'type' => 'write',
  'name' => 'Live Chat Messages Transition',
  'description' => 'Live Chat Messages Transition (POST /youtube/v3/liveChat/messages/transition).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_chat_messages_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatMessagesList',
  'type' => 'read',
  'name' => 'Live Chat Messages List',
  'description' => 'Live Chat Messages List (GET /youtube/v3/liveChat/messages).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_live_chat_messages_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatMessagesDelete',
  'type' => 'write',
  'name' => 'Live Chat Messages Delete',
  'description' => 'Live Chat Messages Delete (DELETE /youtube/v3/liveChat/messages).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_chat_messages_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatMessagesInsert',
  'type' => 'write',
  'name' => 'Live Chat Messages Insert',
  'description' => 'Live Chat Messages Insert (POST /youtube/v3/liveChat/messages).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_search_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeSearchList',
  'type' => 'read',
  'name' => 'Search List',
  'description' => 'Search List (GET /youtube/v3/search).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_channel_banners_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelBannersInsert',
  'type' => 'write',
  'name' => 'Channel Banners Insert',
  'description' => 'Channel Banners Insert (POST /youtube/v3/channelBanners/insert).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_comments_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentsInsert',
  'type' => 'write',
  'name' => 'Comments Insert',
  'description' => 'Comments Insert (POST /youtube/v3/comments).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_comments_mark_as_spam' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentsMarkAsSpam',
  'type' => 'write',
  'name' => 'Comments Mark As Spam',
  'description' => 'Comments Mark As Spam (POST /youtube/v3/comments/markAsSpam).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_comments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentsList',
  'type' => 'read',
  'name' => 'Comments List',
  'description' => 'Comments List (GET /youtube/v3/comments).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_comments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentsDelete',
  'type' => 'write',
  'name' => 'Comments Delete',
  'description' => 'Comments Delete (DELETE /youtube/v3/comments).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_comments_set_moderation_status' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentsSetModerationStatus',
  'type' => 'write',
  'name' => 'Comments Set Moderation Status',
  'description' => 'Comments Set Moderation Status (POST /youtube/v3/comments/setModerationStatus).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_comments_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentsUpdate',
  'type' => 'write',
  'name' => 'Comments Update',
  'description' => 'Comments Update (PUT /youtube/v3/comments).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_video_categories_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideoCategoriesList',
  'type' => 'read',
  'name' => 'Video Categories List',
  'description' => 'Video Categories List (GET /youtube/v3/videoCategories).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_i18n_regions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeI18nRegionsList',
  'type' => 'read',
  'name' => 'I18n Regions List',
  'description' => 'I18n Regions List (GET /youtube/v3/i18nRegions).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_playlist_images_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistImagesList',
  'type' => 'read',
  'name' => 'Playlist Images List',
  'description' => 'Playlist Images List (GET /youtube/v3/playlistImages).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_playlist_images_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistImagesDelete',
  'type' => 'write',
  'name' => 'Playlist Images Delete',
  'description' => 'Playlist Images Delete (DELETE /youtube/v3/playlistImages).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlist_images_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistImagesInsert',
  'type' => 'write',
  'name' => 'Playlist Images Insert',
  'description' => 'Playlist Images Insert (POST /youtube/v3/playlistImages).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlist_images_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistImagesUpdate',
  'type' => 'write',
  'name' => 'Playlist Images Update',
  'description' => 'Playlist Images Update (PUT /youtube/v3/playlistImages).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_super_chat_events_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeSuperChatEventsList',
  'type' => 'read',
  'name' => 'Super Chat Events List',
  'description' => 'Super Chat Events List (GET /youtube/v3/superChatEvents).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_members_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeMembersList',
  'type' => 'read',
  'name' => 'Members List',
  'description' => 'Members List (GET /youtube/v3/members).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_videos_rate' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosRate',
  'type' => 'write',
  'name' => 'Videos Rate',
  'description' => 'Videos Rate (POST /youtube/v3/videos/rate).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_videos_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosInsert',
  'type' => 'write',
  'name' => 'Videos Insert',
  'description' => 'Videos Insert (POST /youtube/v3/videos).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_videos_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosList',
  'type' => 'read',
  'name' => 'Videos List',
  'description' => 'Videos List (GET /youtube/v3/videos).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_videos_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosDelete',
  'type' => 'write',
  'name' => 'Videos Delete',
  'description' => 'Videos Delete (DELETE /youtube/v3/videos).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_videos_get_rating' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosGetRating',
  'type' => 'read',
  'name' => 'Videos Get Rating',
  'description' => 'Videos Get Rating (GET /youtube/v3/videos/getRating).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_videos_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosUpdate',
  'type' => 'write',
  'name' => 'Videos Update',
  'description' => 'Videos Update (PUT /youtube/v3/videos).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_videos_report_abuse' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideosReportAbuse',
  'type' => 'write',
  'name' => 'Videos Report Abuse',
  'description' => 'Videos Report Abuse (POST /youtube/v3/videos/reportAbuse).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlist_items_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistItemsInsert',
  'type' => 'write',
  'name' => 'Playlist Items Insert',
  'description' => 'Playlist Items Insert (POST /youtube/v3/playlistItems).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlist_items_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistItemsUpdate',
  'type' => 'write',
  'name' => 'Playlist Items Update',
  'description' => 'Playlist Items Update (PUT /youtube/v3/playlistItems).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlist_items_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistItemsList',
  'type' => 'read',
  'name' => 'Playlist Items List',
  'description' => 'Playlist Items List (GET /youtube/v3/playlistItems).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_playlist_items_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistItemsDelete',
  'type' => 'write',
  'name' => 'Playlist Items Delete',
  'description' => 'Playlist Items Delete (DELETE /youtube/v3/playlistItems).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_abuse_reports_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeAbuseReportsInsert',
  'type' => 'write',
  'name' => 'Abuse Reports Insert',
  'description' => 'Abuse Reports Insert (POST /youtube/v3/abuseReports).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_youtube_v3_update_comment_threads' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeYoutubeV3UpdateCommentThreads',
  'type' => 'write',
  'name' => 'Youtube V3 Update Comment Threads',
  'description' => 'Youtube V3 Update Comment Threads (PUT /youtube/v3/commentThreads).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_youtube_v3_live_chat_messages_stream' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeYoutubeV3LiveChatMessagesStream',
  'type' => 'read',
  'name' => 'Youtube V3 Live Chat Messages Stream',
  'description' => 'Youtube V3 Live Chat Messages Stream (GET /youtube/v3/liveChat/messages/stream).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_tests_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeTestsInsert',
  'type' => 'write',
  'name' => 'Tests Insert',
  'description' => 'Tests Insert (POST /youtube/v3/tests).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_watermarks_set' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeWatermarksSet',
  'type' => 'write',
  'name' => 'Watermarks Set',
  'description' => 'Watermarks Set (POST /youtube/v3/watermarks/set).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_watermarks_unset' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeWatermarksUnset',
  'type' => 'write',
  'name' => 'Watermarks Unset',
  'description' => 'Watermarks Unset (POST /youtube/v3/watermarks/unset).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_broadcasts_transition' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsTransition',
  'type' => 'write',
  'name' => 'Live Broadcasts Transition',
  'description' => 'Live Broadcasts Transition (POST /youtube/v3/liveBroadcasts/transition).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_broadcasts_insert_cuepoint' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsInsertCuepoint',
  'type' => 'write',
  'name' => 'Live Broadcasts Insert Cuepoint',
  'description' => 'Live Broadcasts Insert Cuepoint (POST /youtube/v3/liveBroadcasts/cuepoint).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_broadcasts_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsInsert',
  'type' => 'write',
  'name' => 'Live Broadcasts Insert',
  'description' => 'Live Broadcasts Insert (POST /youtube/v3/liveBroadcasts).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_broadcasts_bind' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsBind',
  'type' => 'write',
  'name' => 'Live Broadcasts Bind',
  'description' => 'Live Broadcasts Bind (POST /youtube/v3/liveBroadcasts/bind).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_broadcasts_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsList',
  'type' => 'read',
  'name' => 'Live Broadcasts List',
  'description' => 'Live Broadcasts List (GET /youtube/v3/liveBroadcasts).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_live_broadcasts_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsDelete',
  'type' => 'write',
  'name' => 'Live Broadcasts Delete',
  'description' => 'Live Broadcasts Delete (DELETE /youtube/v3/liveBroadcasts).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_broadcasts_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveBroadcastsUpdate',
  'type' => 'write',
  'name' => 'Live Broadcasts Update',
  'description' => 'Live Broadcasts Update (PUT /youtube/v3/liveBroadcasts).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_channels_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelsUpdate',
  'type' => 'write',
  'name' => 'Channels Update',
  'description' => 'Channels Update (PUT /youtube/v3/channels).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_channels_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeChannelsList',
  'type' => 'read',
  'name' => 'Channels List',
  'description' => 'Channels List (GET /youtube/v3/channels).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_memberships_levels_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeMembershipsLevelsList',
  'type' => 'read',
  'name' => 'Memberships Levels List',
  'description' => 'Memberships Levels List (GET /youtube/v3/membershipsLevels).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_i18n_languages_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeI18nLanguagesList',
  'type' => 'read',
  'name' => 'I18n Languages List',
  'description' => 'I18n Languages List (GET /youtube/v3/i18nLanguages).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_video_abuse_report_reasons_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeVideoAbuseReportReasonsList',
  'type' => 'read',
  'name' => 'Video Abuse Report Reasons List',
  'description' => 'Video Abuse Report Reasons List (GET /youtube/v3/videoAbuseReportReasons).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_playlists_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistsList',
  'type' => 'read',
  'name' => 'Playlists List',
  'description' => 'Playlists List (GET /youtube/v3/playlists).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_playlists_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistsDelete',
  'type' => 'write',
  'name' => 'Playlists Delete',
  'description' => 'Playlists Delete (DELETE /youtube/v3/playlists).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlists_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistsInsert',
  'type' => 'write',
  'name' => 'Playlists Insert',
  'description' => 'Playlists Insert (POST /youtube/v3/playlists).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_playlists_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubePlaylistsUpdate',
  'type' => 'write',
  'name' => 'Playlists Update',
  'description' => 'Playlists Update (PUT /youtube/v3/playlists).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_subscriptions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeSubscriptionsList',
  'type' => 'read',
  'name' => 'Subscriptions List',
  'description' => 'Subscriptions List (GET /youtube/v3/subscriptions).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_subscriptions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeSubscriptionsDelete',
  'type' => 'write',
  'name' => 'Subscriptions Delete',
  'description' => 'Subscriptions Delete (DELETE /youtube/v3/subscriptions).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_subscriptions_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeSubscriptionsInsert',
  'type' => 'write',
  'name' => 'Subscriptions Insert',
  'description' => 'Subscriptions Insert (POST /youtube/v3/subscriptions).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_chat_bans_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatBansInsert',
  'type' => 'write',
  'name' => 'Live Chat Bans Insert',
  'description' => 'Live Chat Bans Insert (POST /youtube/v3/liveChat/bans).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_chat_bans_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveChatBansDelete',
  'type' => 'write',
  'name' => 'Live Chat Bans Delete',
  'description' => 'Live Chat Bans Delete (DELETE /youtube/v3/liveChat/bans).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_thumbnails_set' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeThumbnailsSet',
  'type' => 'write',
  'name' => 'Thumbnails Set',
  'description' => 'Thumbnails Set (POST /youtube/v3/thumbnails/set).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_captions_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCaptionsInsert',
  'type' => 'write',
  'name' => 'Captions Insert',
  'description' => 'Captions Insert (POST /youtube/v3/captions).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_captions_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCaptionsUpdate',
  'type' => 'write',
  'name' => 'Captions Update',
  'description' => 'Captions Update (PUT /youtube/v3/captions).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_captions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCaptionsList',
  'type' => 'read',
  'name' => 'Captions List',
  'description' => 'Captions List (GET /youtube/v3/captions).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_captions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCaptionsDelete',
  'type' => 'write',
  'name' => 'Captions Delete',
  'description' => 'Captions Delete (DELETE /youtube/v3/captions).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_captions_download' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCaptionsDownload',
  'type' => 'read',
  'name' => 'Captions Download',
  'description' => 'Captions Download (GET /youtube/v3/captions/{id}).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_live_streams_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveStreamsInsert',
  'type' => 'write',
  'name' => 'Live Streams Insert',
  'description' => 'Live Streams Insert (POST /youtube/v3/liveStreams).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_streams_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveStreamsUpdate',
  'type' => 'write',
  'name' => 'Live Streams Update',
  'description' => 'Live Streams Update (PUT /youtube/v3/liveStreams).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_live_streams_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveStreamsList',
  'type' => 'read',
  'name' => 'Live Streams List',
  'description' => 'Live Streams List (GET /youtube/v3/liveStreams).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_live_streams_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeLiveStreamsDelete',
  'type' => 'write',
  'name' => 'Live Streams Delete',
  'description' => 'Live Streams Delete (DELETE /youtube/v3/liveStreams).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_comment_threads_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentThreadsList',
  'type' => 'read',
  'name' => 'Comment Threads List',
  'description' => 'Comment Threads List (GET /youtube/v3/commentThreads).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_comment_threads_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeCommentThreadsInsert',
  'type' => 'write',
  'name' => 'Comment Threads Insert',
  'description' => 'Comment Threads Insert (POST /youtube/v3/commentThreads).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_third_party_links_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeThirdPartyLinksInsert',
  'type' => 'write',
  'name' => 'Third Party Links Insert',
  'description' => 'Third Party Links Insert (POST /youtube/v3/thirdPartyLinks).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_third_party_links_update' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeThirdPartyLinksUpdate',
  'type' => 'write',
  'name' => 'Third Party Links Update',
  'description' => 'Third Party Links Update (PUT /youtube/v3/thirdPartyLinks).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_third_party_links_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeThirdPartyLinksList',
  'type' => 'read',
  'name' => 'Third Party Links List',
  'description' => 'Third Party Links List (GET /youtube/v3/thirdPartyLinks).',
  'icon' => 'ph:magnifying-glass',
),
        'youtube_third_party_links_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeThirdPartyLinksDelete',
  'type' => 'write',
  'name' => 'Third Party Links Delete',
  'description' => 'Third Party Links Delete (DELETE /youtube/v3/thirdPartyLinks).',
  'icon' => 'ph:youtube-logo',
),
        'youtube_activities_list' => array (
  'class' => '\\OpenCompany\\Integrations\\YouTube\\Tools\\YouTubeActivitiesList',
  'type' => 'read',
  'name' => 'Activities List',
  'description' => 'Activities List (GET /youtube/v3/activities).',
  'icon' => 'ph:magnifying-glass',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): YouTubeService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new YouTubeService(accessToken: $creds->get('youtube','access_token','',$account), apiKey: $creds->get('youtube','api_key','',$account), baseUrl: $creds->get('youtube','url','https://youtube.googleapis.com',$account));} return app(YouTubeService::class); }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/youtube.md'; }
}

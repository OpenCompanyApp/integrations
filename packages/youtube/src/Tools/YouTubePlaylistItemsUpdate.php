<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Playlist Items Update.
 *
 * Maps to the official YouTube Data API endpoint PUT /youtube/v3/playlistItems.
 */
class YouTubePlaylistItemsUpdate extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_playlist_items_update';
    protected const DESCRIPTION = 'Playlist Items Update

Official YouTube Data API endpoint: PUT /youtube/v3/playlistItems
Updates an existing resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOfContentOwner, part.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include. Note that this method will override the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies. For example, a playlist item can specify a start time and end time, which identify the times portion of the video that should play when users watch the video in the playlist. If your request is updating a playlist item that sets these values, and the request\'s part parameter value includes the contentDetails part, the playlist item\'s start and end times will be updated to whatever value the request body specifies. If the request body does not specify values, the existing start and end times will be removed and replaced with the default settings.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `PlaylistItem` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/youtube/v3/playlistItems';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOfContentOwner',
  1 => 'part',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

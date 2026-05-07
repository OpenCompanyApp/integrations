<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Playlist Items List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/playlistItems.
 */
class YouTubePlaylistItemsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_playlist_items_list';
    protected const DESCRIPTION = 'Playlist Items List

Official YouTube Data API endpoint: GET /youtube/v3/playlistItems
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: videoId, part, onBehalfOfContentOwner, id, playlistId, maxResults, pageToken.',
  ),
  'videoId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the playlist items associated with the given video ID.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more playlistItem resource properties that the API response will include. If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a playlistItem resource, the snippet property contains numerous fields, including the title, description, position, and resourceId properties. As such, if you set *part=snippet*, the API response will contain all of those properties.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'playlistId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the playlist items within the given playlist.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/playlistItems';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'videoId',
  1 => 'part',
  2 => 'onBehalfOfContentOwner',
  3 => 'id',
  4 => 'playlistId',
  5 => 'maxResults',
  6 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

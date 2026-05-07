<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Channels List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/channels.
 */
class YouTubeChannelsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_channels_list';
    protected const DESCRIPTION = 'Channels List

Official YouTube Data API endpoint: GET /youtube/v3/channels
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, managedByMe, categoryId, mine, forHandle, hl, mySubscribers, forUsername, maxResults, pageToken, onBehalfOfContentOwner, id.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more channel resource properties that the API response will include. If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a channel resource, the contentDetails property contains other properties, such as the uploads properties. As such, if you set *part=contentDetails*, the API response will also contain all of those nested properties.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'managedByMe' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Return the channels managed by the authenticated user.',
  ),
  'categoryId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the channels within the specified guide category ID.',
  ),
  'mine' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Return the ids of channels owned by the authenticated user.',
  ),
  'forHandle' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the channel associated with a YouTube handle.',
  ),
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Stands for "host language". Specifies the localization language of the metadata to be filled into snippet.localized. The field is filled with the default metadata if there is no localization in the specified language. The parameter value must be a language code included in the list returned by the i18nLanguages.list method (e.g. en_US, es_MX).',
  ),
  'mySubscribers' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Return the channels subscribed to the authenticated user',
  ),
  'forUsername' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the channel associated with a YouTube username.',
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
    'description' => 'Return the channels with the specified IDs.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/channels';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'managedByMe',
  2 => 'categoryId',
  3 => 'mine',
  4 => 'forHandle',
  5 => 'hl',
  6 => 'mySubscribers',
  7 => 'forUsername',
  8 => 'maxResults',
  9 => 'pageToken',
  10 => 'onBehalfOfContentOwner',
  11 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

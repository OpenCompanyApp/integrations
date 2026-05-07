<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Videos List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/videos.
 */
class YouTubeVideosList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_videos_list';
    protected const DESCRIPTION = 'Videos List

Official YouTube Data API endpoint: GET /youtube/v3/videos
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: maxWidth, pageToken, locale, maxResults, id, onBehalfOfContentOwner, hl, myRating, part, videoCategoryId, chart, maxHeight, regionCode.',
  ),
  'maxWidth' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Return the player with maximum height specified in',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved. *Note:* This parameter is supported for use in conjunction with the myRating and chart parameters, but it is not supported for use in conjunction with the id parameter.',
  ),
  'locale' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `locale`.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set. *Note:* This parameter is supported for use in conjunction with the myRating and chart parameters, but it is not supported for use in conjunction with the id parameter.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Return videos with the given ids.',
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
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Stands for "host language". Specifies the localization language of the metadata to be filled into snippet.localized. The field is filled with the default metadata if there is no localization in the specified language. The parameter value must be a language code included in the list returned by the i18nLanguages.list method (e.g. en_US, es_MX).',
  ),
  'myRating' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return videos liked/disliked by the authenticated user. Does not support RateType.RATED_TYPE_NONE.',
    'enum' =>
    array (
      0 => 'none',
      1 => 'like',
      2 => 'dislike',
    ),
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more video resource properties that the API response will include. If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a video resource, the snippet property contains the channelId, title, description, tags, and categoryId properties. As such, if you set *part=snippet*, the API response will contain all of those properties.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'videoCategoryId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Use chart that is specific to the specified video category',
  ),
  'chart' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the videos that are in the specified chart.',
    'enum' =>
    array (
      0 => 'chartUnspecified',
      1 => 'mostPopular',
    ),
  ),
  'maxHeight' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxHeight`.',
  ),
  'regionCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Use a chart that is specific to the specified region',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/videos';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxWidth',
  1 => 'pageToken',
  2 => 'locale',
  3 => 'maxResults',
  4 => 'id',
  5 => 'onBehalfOfContentOwner',
  6 => 'hl',
  7 => 'myRating',
  8 => 'part',
  9 => 'videoCategoryId',
  10 => 'chart',
  11 => 'maxHeight',
  12 => 'regionCode',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

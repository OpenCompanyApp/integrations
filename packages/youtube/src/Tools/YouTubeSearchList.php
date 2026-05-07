<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Search List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/search.
 */
class YouTubeSearchList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_search_list';
    protected const DESCRIPTION = 'Search List

Official YouTube Data API endpoint: GET /youtube/v3/search
Retrieves a list of search resources';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: forContentOwner, videoLicense, eventType, videoPaidProductPlacement, videoEmbeddable, videoDuration, forMine, order, pageToken, channelId, safeSearch, location, q, forDeveloper, videoCategoryId, channelType, locationRadius, videoSyndicated, regionCode, videoDefinition, relevanceLanguage, onBehalfOfContentOwner, maxResults, publishedAfter, publishedBefore, videoDimension, videoCaption, videoType, type, topicId, part.',
  ),
  'forContentOwner' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Search owned by a content owner.',
  ),
  'videoLicense' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on the license of the videos.',
    'enum' =>
    array (
      0 => 'any',
      1 => 'youtube',
      2 => 'creativeCommon',
    ),
  ),
  'eventType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on the livestream status of the videos.',
    'enum' =>
    array (
      0 => 'none',
      1 => 'upcoming',
      2 => 'live',
      3 => 'completed',
    ),
  ),
  'videoPaidProductPlacement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `videoPaidProductPlacement`.',
    'enum' =>
    array (
      0 => 'videoPaidProductPlacementUnspecified',
      1 => 'any',
      2 => 'true',
    ),
  ),
  'videoEmbeddable' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on embeddable videos.',
    'enum' =>
    array (
      0 => 'videoEmbeddableUnspecified',
      1 => 'any',
      2 => 'true',
    ),
  ),
  'videoDuration' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on the duration of the videos.',
    'enum' =>
    array (
      0 => 'videoDurationUnspecified',
      1 => 'any',
      2 => 'short',
      3 => 'medium',
      4 => 'long',
    ),
  ),
  'forMine' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Search for the private videos of the authenticated user.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Sort order of the results.',
    'enum' =>
    array (
      0 => 'searchSortUnspecified',
      1 => 'date',
      2 => 'rating',
      3 => 'viewCount',
      4 => 'relevance',
      5 => 'title',
      6 => 'videoCount',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.',
  ),
  'channelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on resources belonging to this channelId.',
  ),
  'safeSearch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Indicates whether the search results should include restricted content as well as standard content.',
    'enum' =>
    array (
      0 => 'safeSearchSettingUnspecified',
      1 => 'none',
      2 => 'moderate',
      3 => 'strict',
    ),
  ),
  'location' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on location of the video',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Textual search terms to match.',
  ),
  'forDeveloper' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Restrict the search to only retrieve videos uploaded using the project id of the authenticated user.',
  ),
  'videoCategoryId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on videos in a specific category.',
  ),
  'channelType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Add a filter on the channel search.',
    'enum' =>
    array (
      0 => 'channelTypeUnspecified',
      1 => 'any',
      2 => 'show',
    ),
  ),
  'locationRadius' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on distance from the location (specified above).',
  ),
  'videoSyndicated' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on syndicated videos.',
    'enum' =>
    array (
      0 => 'videoSyndicatedUnspecified',
      1 => 'any',
      2 => 'true',
    ),
  ),
  'regionCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Display the content as seen by viewers in this country.',
  ),
  'videoDefinition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on the definition of the videos.',
    'enum' =>
    array (
      0 => 'any',
      1 => 'standard',
      2 => 'high',
    ),
  ),
  'relevanceLanguage' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return results relevant to this language.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
  'publishedAfter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on resources published after this date.',
  ),
  'publishedBefore' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on resources published before this date.',
  ),
  'videoDimension' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on 3d videos.',
    'enum' =>
    array (
      0 => 'any',
      1 => '2d',
      2 => '3d',
    ),
  ),
  'videoCaption' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on the presence of captions on the videos.',
    'enum' =>
    array (
      0 => 'videoCaptionUnspecified',
      1 => 'any',
      2 => 'closedCaption',
      3 => 'none',
    ),
  ),
  'videoType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter on videos of a specific type.',
    'enum' =>
    array (
      0 => 'videoTypeUnspecified',
      1 => 'any',
      2 => 'movie',
      3 => 'episode',
    ),
  ),
  'type' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Restrict results to a particular set of resource types from One Platform.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'topicId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Restrict results to a particular topic.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more search resource properties that the API response will include. Set the parameter value to snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/search';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'forContentOwner',
  1 => 'videoLicense',
  2 => 'eventType',
  3 => 'videoPaidProductPlacement',
  4 => 'videoEmbeddable',
  5 => 'videoDuration',
  6 => 'forMine',
  7 => 'order',
  8 => 'pageToken',
  9 => 'channelId',
  10 => 'safeSearch',
  11 => 'location',
  12 => 'q',
  13 => 'forDeveloper',
  14 => 'videoCategoryId',
  15 => 'channelType',
  16 => 'locationRadius',
  17 => 'videoSyndicated',
  18 => 'regionCode',
  19 => 'videoDefinition',
  20 => 'relevanceLanguage',
  21 => 'onBehalfOfContentOwner',
  22 => 'maxResults',
  23 => 'publishedAfter',
  24 => 'publishedBefore',
  25 => 'videoDimension',
  26 => 'videoCaption',
  27 => 'videoType',
  28 => 'type',
  29 => 'topicId',
  30 => 'part',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

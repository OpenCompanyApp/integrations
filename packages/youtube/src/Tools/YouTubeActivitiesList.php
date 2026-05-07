<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Activities List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/activities.
 */
class YouTubeActivitiesList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_activities_list';
    protected const DESCRIPTION = 'Activities List

Official YouTube Data API endpoint: GET /youtube/v3/activities
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: mine, part, regionCode, maxResults, pageToken, home, publishedBefore, publishedAfter, channelId.',
  ),
  'mine' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `mine`.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more activity resource properties that the API response will include. If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in an activity resource, the snippet property contains other properties that identify the type of activity, a display title for the activity, and so forth. If you set *part=snippet*, the API response will also contain all of those nested properties.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'regionCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `regionCode`.',
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
  'home' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `home`.',
  ),
  'publishedBefore' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `publishedBefore`.',
  ),
  'publishedAfter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `publishedAfter`.',
  ),
  'channelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `channelId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/activities';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'mine',
  1 => 'part',
  2 => 'regionCode',
  3 => 'maxResults',
  4 => 'pageToken',
  5 => 'home',
  6 => 'publishedBefore',
  7 => 'publishedAfter',
  8 => 'channelId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

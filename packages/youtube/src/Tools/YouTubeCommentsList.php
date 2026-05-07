<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Comments List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/comments.
 */
class YouTubeCommentsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_comments_list';
    protected const DESCRIPTION = 'Comments List

Official YouTube Data API endpoint: GET /youtube/v3/comments
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: parentId, part, maxResults, textFormat, pageToken, id.',
  ),
  'parentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Returns replies to the specified comment. Note, currently YouTube features only one level of replies (ie replies to top level comments). However replies to replies may be supported in the future.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more comment resource properties that the API response will include.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
  'textFormat' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The requested text format for the returned comments.',
    'enum' =>
    array (
      0 => 'textFormatUnspecified',
      1 => 'html',
      2 => 'plainText',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Returns the comments with the given IDs for One Platform.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/comments';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'parentId',
  1 => 'part',
  2 => 'maxResults',
  3 => 'textFormat',
  4 => 'pageToken',
  5 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

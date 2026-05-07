<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Comments Insert.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/comments.
 */
class YouTubeCommentsInsert extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_comments_insert';
    protected const DESCRIPTION = 'Comments Insert

Official YouTube Data API endpoint: POST /youtube/v3/comments
Inserts a new resource into this collection.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter identifies the properties that the API response will include. Set the parameter value to snippet. The snippet part has a quota cost of 2 units.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `Comment` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/comments';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

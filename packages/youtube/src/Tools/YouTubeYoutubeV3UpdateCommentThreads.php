<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Youtube V3 Update Comment Threads.
 *
 * Maps to the official YouTube Data API endpoint PUT /youtube/v3/commentThreads.
 */
class YouTubeYoutubeV3UpdateCommentThreads extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_youtube_v3_update_comment_threads';
    protected const DESCRIPTION = 'Youtube V3 Update Comment Threads

Official YouTube Data API endpoint: PUT /youtube/v3/commentThreads
Updates an existing resource.';
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
    'required' => false,
    'description' => 'The *part* parameter specifies a comma-separated list of commentThread resource properties that the API response will include. You must at least include the snippet part in the parameter value since that part contains all of the properties that the API request can update.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `CommentThread` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/youtube/v3/commentThreads';
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

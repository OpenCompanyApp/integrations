<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Comments Delete.
 *
 * Maps to the official YouTube Data API endpoint DELETE /youtube/v3/comments.
 */
class YouTubeCommentsDelete extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_comments_delete';
    protected const DESCRIPTION = 'Comments Delete

Official YouTube Data API endpoint: DELETE /youtube/v3/comments
Deletes a resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Shortcut for query parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/youtube/v3/comments';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

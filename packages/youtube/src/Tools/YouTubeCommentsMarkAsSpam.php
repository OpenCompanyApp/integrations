<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Comments Mark As Spam.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/comments/markAsSpam.
 */
class YouTubeCommentsMarkAsSpam extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_comments_mark_as_spam';
    protected const DESCRIPTION = 'Comments Mark As Spam

Official YouTube Data API endpoint: POST /youtube/v3/comments/markAsSpam
Expresses the caller\'s opinion that one or more comments should be flagged as spam.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'Flags the comments with the given IDs as spam in the caller\'s opinion.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/comments/markAsSpam';
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

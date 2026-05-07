<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Comments Set Moderation Status.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/comments/setModerationStatus.
 */
class YouTubeCommentsSetModerationStatus extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_comments_set_moderation_status';
    protected const DESCRIPTION = 'Comments Set Moderation Status

Official YouTube Data API endpoint: POST /youtube/v3/comments/setModerationStatus
Sets the moderation status of one or more comments.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: moderationStatus, banAuthor, id.',
  ),
  'moderationStatus' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Specifies the requested moderation status. Note, comments can be in statuses, which are not available through this call. For example, this call does not allow to mark a comment as \'likely spam\'. Valid values: \'heldForReview\', \'published\' or \'rejected\'.',
    'enum' =>
    array (
      0 => 'published',
      1 => 'heldForReview',
      2 => 'likelySpam',
      3 => 'rejected',
    ),
  ),
  'banAuthor' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'If set to true the author of the comment gets added to the ban list. This means all future comments of the author will autmomatically be rejected. Only valid in combination with STATUS_REJECTED.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'Modifies the moderation status of the comments with the given IDs',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/comments/setModerationStatus';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'moderationStatus',
  1 => 'banAuthor',
  2 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

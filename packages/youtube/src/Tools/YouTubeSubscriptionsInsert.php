<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Subscriptions Insert.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/subscriptions.
 */
class YouTubeSubscriptionsInsert extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_subscriptions_insert';
    protected const DESCRIPTION = 'Subscriptions Insert

Official YouTube Data API endpoint: POST /youtube/v3/subscriptions
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
    'description' => 'The *part* parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `Subscription` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/subscriptions';
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

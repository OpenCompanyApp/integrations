<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Tests Insert.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/tests.
 */
class YouTubeTestsInsert extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_tests_insert';
    protected const DESCRIPTION = 'Tests Insert

Official YouTube Data API endpoint: POST /youtube/v3/tests
POST method.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOfContentOwnerChannel, externalChannelId, part.',
  ),
  'onBehalfOfContentOwnerChannel' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `onBehalfOfContentOwnerChannel`.',
  ),
  'externalChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `externalChannelId`.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'Shortcut for query parameter `part`.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `TestItem` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/tests';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOfContentOwnerChannel',
  1 => 'externalChannelId',
  2 => 'part',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Third Party Links Insert.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/thirdPartyLinks.
 */
class YouTubeThirdPartyLinksInsert extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_third_party_links_insert';
    protected const DESCRIPTION = 'Third Party Links Insert

Official YouTube Data API endpoint: POST /youtube/v3/thirdPartyLinks
Inserts a new resource into this collection.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, externalChannelId.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the thirdPartyLink resource parts that the API request and response will include. Supported values are linkingToken, status, and snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'externalChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Channel ID to which changes should be applied, for delegation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `ThirdPartyLink` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/thirdPartyLinks';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'externalChannelId',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

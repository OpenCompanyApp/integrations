<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Third Party Links Update.
 *
 * Maps to the official YouTube Data API endpoint PUT /youtube/v3/thirdPartyLinks.
 */
class YouTubeThirdPartyLinksUpdate extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_third_party_links_update';
    protected const DESCRIPTION = 'Third Party Links Update

Official YouTube Data API endpoint: PUT /youtube/v3/thirdPartyLinks
Updates an existing resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: externalChannelId, part.',
  ),
  'externalChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Channel ID to which changes should be applied, for delegation.',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `ThirdPartyLink` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/youtube/v3/thirdPartyLinks';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'externalChannelId',
  1 => 'part',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

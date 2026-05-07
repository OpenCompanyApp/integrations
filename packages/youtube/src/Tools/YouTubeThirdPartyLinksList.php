<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Third Party Links List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/thirdPartyLinks.
 */
class YouTubeThirdPartyLinksList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_third_party_links_list';
    protected const DESCRIPTION = 'Third Party Links List

Official YouTube Data API endpoint: GET /youtube/v3/thirdPartyLinks
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: type, linkingToken, part, externalChannelId.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Get a third party link of the given type.',
    'enum' =>
    array (
      0 => 'linkUnspecified',
      1 => 'channelToStoreLink',
    ),
  ),
  'linkingToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Get a third party link with the given linking token.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the thirdPartyLink resource parts that the API response will include. Supported values are linkingToken, status, and snippet.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/thirdPartyLinks';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'type',
  1 => 'linkingToken',
  2 => 'part',
  3 => 'externalChannelId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Third Party Links Delete.
 *
 * Maps to the official YouTube Data API endpoint DELETE /youtube/v3/thirdPartyLinks.
 */
class YouTubeThirdPartyLinksDelete extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_third_party_links_delete';
    protected const DESCRIPTION = 'Third Party Links Delete

Official YouTube Data API endpoint: DELETE /youtube/v3/thirdPartyLinks
Deletes a resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: externalChannelId, linkingToken, part, type.',
  ),
  'externalChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Channel ID to which changes should be applied, for delegation.',
  ),
  'linkingToken' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Delete the partner links with the given linking token.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Do not use. Required for compatibility.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Type of the link to be deleted.',
    'enum' =>
    array (
      0 => 'linkUnspecified',
      1 => 'channelToStoreLink',
    ),
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/youtube/v3/thirdPartyLinks';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'externalChannelId',
  1 => 'linkingToken',
  2 => 'part',
  3 => 'type',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

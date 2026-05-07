<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Watermarks Unset.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/watermarks/unset.
 */
class YouTubeWatermarksUnset extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_watermarks_unset';
    protected const DESCRIPTION = 'Watermarks Unset

Official YouTube Data API endpoint: POST /youtube/v3/watermarks/unset
Allows removal of channel watermark.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: channelId, onBehalfOfContentOwner.',
  ),
  'channelId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Shortcut for query parameter `channelId`.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/watermarks/unset';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'channelId',
  1 => 'onBehalfOfContentOwner',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

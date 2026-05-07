<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Captions Download.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/captions/{id}.
 */
class YouTubeCaptionsDownload extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_captions_download';
    protected const DESCRIPTION = 'Captions Download

Official YouTube Data API endpoint: GET /youtube/v3/captions/{id}
Downloads a caption track.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official YouTube Data API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOf, onBehalfOfContentOwner, tlang, tfmt.',
  ),
  'onBehalfOf' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'ID of the Google+ Page for the channel that the request is be on behalf of',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The actual CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'tlang' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'tlang is the language code; machine translate the captions into this language.',
  ),
  'tfmt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Convert the captions into this format. Supported options are sbv, srt, and vtt.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/captions/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOf',
  1 => 'onBehalfOfContentOwner',
  2 => 'tlang',
  3 => 'tfmt',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

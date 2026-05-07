<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Captions List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/captions.
 */
class YouTubeCaptionsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_captions_list';
    protected const DESCRIPTION = 'Captions List

Official YouTube Data API endpoint: GET /youtube/v3/captions
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOf, onBehalfOfContentOwner, id, videoId, part.',
  ),
  'onBehalfOf' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'ID of the Google+ Page for the channel that the request is on behalf of.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The actual CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Returns the captions with the given IDs for Stubby or Apiary.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'videoId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Returns the captions for the specified video.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more caption resource parts that the API response will include. The part names that you can include in the parameter value are id and snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/captions';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOf',
  1 => 'onBehalfOfContentOwner',
  2 => 'id',
  3 => 'videoId',
  4 => 'part',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

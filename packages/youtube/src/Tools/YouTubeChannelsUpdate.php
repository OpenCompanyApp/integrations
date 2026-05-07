<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Channels Update.
 *
 * Maps to the official YouTube Data API endpoint PUT /youtube/v3/channels.
 */
class YouTubeChannelsUpdate extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_channels_update';
    protected const DESCRIPTION = 'Channels Update

Official YouTube Data API endpoint: PUT /youtube/v3/channels
Updates an existing resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, onBehalfOfContentOwner.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include. The API currently only allows the parameter value to be set to either brandingSettings or invideoPromotion. (You cannot update both of those parts with a single request.) Note that this method overrides the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *onBehalfOfContentOwner* parameter indicates that the authenticated user is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The actual CMS account that the user authenticates with needs to be linked to the specified YouTube content owner.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `Channel` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/youtube/v3/channels';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'onBehalfOfContentOwner',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

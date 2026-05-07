<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Broadcasts Insert Cuepoint.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/liveBroadcasts/cuepoint.
 */
class YouTubeLiveBroadcastsInsertCuepoint extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_broadcasts_insert_cuepoint';
    protected const DESCRIPTION = 'Live Broadcasts Insert Cuepoint

Official YouTube Data API endpoint: POST /youtube/v3/liveBroadcasts/cuepoint
Insert cuepoints in a broadcast';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id, onBehalfOfContentOwner, onBehalfOfContentOwnerChannel, part.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Broadcast to insert ads to, or equivalently `external_video_id` for internal use.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'onBehalfOfContentOwnerChannel' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'This parameter can only be used in a properly authorized request. *Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwnerChannel* parameter specifies the YouTube channel ID of the channel to which a video is being added. This parameter is required when a request specifies a value for the onBehalfOfContentOwner parameter, and it can only be used in conjunction with that parameter. In addition, the request must be authorized using a CMS account that is linked to the content owner that the onBehalfOfContentOwner parameter specifies. Finally, the channel that the onBehalfOfContentOwnerChannel parameter value specifies must be linked to the content owner that the onBehalfOfContentOwner parameter specifies. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and perform actions on behalf of the channel specified in the parameter value, without having to provide authentication credentials for each separate channel.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more liveBroadcast resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, contentDetails, and status.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `Cuepoint` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/liveBroadcasts/cuepoint';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'onBehalfOfContentOwner',
  2 => 'onBehalfOfContentOwnerChannel',
  3 => 'part',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

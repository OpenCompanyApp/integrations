<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Broadcasts Delete.
 *
 * Maps to the official YouTube Data API endpoint DELETE /youtube/v3/liveBroadcasts.
 */
class YouTubeLiveBroadcastsDelete extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_broadcasts_delete';
    protected const DESCRIPTION = 'Live Broadcasts Delete

Official YouTube Data API endpoint: DELETE /youtube/v3/liveBroadcasts
Delete a given broadcast.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOfContentOwner, onBehalfOfContentOwnerChannel, id.',
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
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Broadcast to delete.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/youtube/v3/liveBroadcasts';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOfContentOwner',
  1 => 'onBehalfOfContentOwnerChannel',
  2 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

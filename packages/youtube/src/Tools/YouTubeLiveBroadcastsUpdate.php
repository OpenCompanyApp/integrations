<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Broadcasts Update.
 *
 * Maps to the official YouTube Data API endpoint PUT /youtube/v3/liveBroadcasts.
 */
class YouTubeLiveBroadcastsUpdate extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_broadcasts_update';
    protected const DESCRIPTION = 'Live Broadcasts Update

Official YouTube Data API endpoint: PUT /youtube/v3/liveBroadcasts
Updates an existing broadcast for the authenticated user.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, onBehalfOfContentOwner, onBehalfOfContentOwnerChannel.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include. The part properties that you can include in the parameter value are id, snippet, contentDetails, and status. Note that this method will override the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies. For example, a broadcast\'s privacy status is defined in the status part. As such, if your request is updating a private or unlisted broadcast, and the request\'s part parameter value includes the status part, the broadcast\'s privacy setting will be updated to whatever value the request body specifies. If the request body does not specify a value, the existing privacy setting will be removed and the broadcast will revert to the default privacy setting.',
    'items' =>
    array (
      'type' => 'string',
    ),
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `LiveBroadcast` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/youtube/v3/liveBroadcasts';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'onBehalfOfContentOwner',
  2 => 'onBehalfOfContentOwnerChannel',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Videos Insert.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/videos.
 */
class YouTubeVideosInsert extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_videos_insert';
    protected const DESCRIPTION = 'Videos Insert

Official YouTube Data API endpoint: POST /youtube/v3/videos
Inserts a new resource into this collection.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: autoLevels, part, onBehalfOfContentOwner, onBehalfOfContentOwnerChannel, notifySubscribers, stabilize.',
  ),
  'autoLevels' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Should auto-levels be applied to the upload.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include. Note that not all parts contain properties that can be set when inserting or updating a video. For example, the statistics object encapsulates statistics that YouTube calculates for a video and does not contain values that you can set or modify. If the parameter value specifies a part that does not contain mutable values, that part will still be included in the API response.',
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
  'notifySubscribers' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Notify the channel subscribers about the new video. As default, the notification is enabled.',
  ),
  'stabilize' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Should stabilize be applied to the upload.',
  ),
  'file_path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Local file path to upload to YouTube for this media endpoint.',
  ),
  'mime_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'MIME type for the uploaded file. Defaults to application/octet-stream.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Optional resource metadata body for multipart media uploads.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/videos';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'autoLevels',
  1 => 'part',
  2 => 'onBehalfOfContentOwner',
  3 => 'onBehalfOfContentOwnerChannel',
  4 => 'notifySubscribers',
  5 => 'stabilize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/youtube/v3/videos';
}

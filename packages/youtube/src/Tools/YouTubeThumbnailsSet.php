<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Thumbnails Set.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/thumbnails/set.
 */
class YouTubeThumbnailsSet extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_thumbnails_set';
    protected const DESCRIPTION = 'Thumbnails Set

Official YouTube Data API endpoint: POST /youtube/v3/thumbnails/set
As this is not an insert in a strict sense (it supports uploading/setting of a thumbnail for multiple videos, which doesn\'t result in creation of a single resource), I use a custom verb here.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOfContentOwner, videoId.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The actual CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'videoId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Returns the Thumbnail with the given video IDs for Stubby or Apiary.',
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
    protected const PATH = '/youtube/v3/thumbnails/set';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOfContentOwner',
  1 => 'videoId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = true;
    protected const MEDIA_UPLOAD_PATH = '/upload/youtube/v3/thumbnails/set';
}

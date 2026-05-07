<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Playlist Images Delete.
 *
 * Maps to the official YouTube Data API endpoint DELETE /youtube/v3/playlistImages.
 */
class YouTubePlaylistImagesDelete extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_playlist_images_delete';
    protected const DESCRIPTION = 'Playlist Images Delete

Official YouTube Data API endpoint: DELETE /youtube/v3/playlistImages
Deletes a resource.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: onBehalfOfContentOwner, id.',
  ),
  'onBehalfOfContentOwner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => '*Note:* This parameter is intended exclusively for YouTube content partners. The *onBehalfOfContentOwner* parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Id to identify this image. This is returned from by the List method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/youtube/v3/playlistImages';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'onBehalfOfContentOwner',
  1 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

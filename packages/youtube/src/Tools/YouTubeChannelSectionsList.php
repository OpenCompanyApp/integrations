<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Channel Sections List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/channelSections.
 */
class YouTubeChannelSectionsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_channel_sections_list';
    protected const DESCRIPTION = 'Channel Sections List

Official YouTube Data API endpoint: GET /youtube/v3/channelSections
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id, onBehalfOfContentOwner, mine, channelId, part, hl.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Return the ChannelSections with the given IDs for Stubby or Apiary.',
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
  'mine' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Return the ChannelSections owned by the authenticated user.',
  ),
  'channelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the ChannelSections owned by the specified channel ID.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more channelSection resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, and contentDetails. If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a channelSection resource, the snippet property contains other properties, such as a display title for the channelSection. If you set *part=snippet*, the API response will also contain all of those nested properties.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return content in specified language',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/channelSections';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'onBehalfOfContentOwner',
  2 => 'mine',
  3 => 'channelId',
  4 => 'part',
  5 => 'hl',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

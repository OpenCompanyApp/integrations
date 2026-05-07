<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Members List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/members.
 */
class YouTubeMembersList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_members_list';
    protected const DESCRIPTION = 'Members List

Official YouTube Data API endpoint: GET /youtube/v3/members
Retrieves a list of members that match the request criteria for a channel.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, mode, hasAccessToLevel, pageToken, filterByMemberChannelId, maxResults.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the member resource parts that the API response will include. Set the parameter value to snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'mode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Parameter that specifies which channel members to return.',
    'enum' =>
    array (
      0 => 'listMembersModeUnknown',
      1 => 'updates',
      2 => 'all_current',
    ),
  ),
  'hasAccessToLevel' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Filter members in the results set to the ones that have access to a level.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.',
  ),
  'filterByMemberChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma separated list of channel IDs. Only data about members that are part of this list will be included in the response.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/members';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'mode',
  2 => 'hasAccessToLevel',
  3 => 'pageToken',
  4 => 'filterByMemberChannelId',
  5 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

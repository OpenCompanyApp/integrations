<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Subscriptions List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/subscriptions.
 */
class YouTubeSubscriptionsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_subscriptions_list';
    protected const DESCRIPTION = 'Subscriptions List

Official YouTube Data API endpoint: GET /youtube/v3/subscriptions
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: channelId, mySubscribers, forChannelId, pageToken, maxResults, id, onBehalfOfContentOwner, onBehalfOfContentOwnerChannel, order, part, mine, myRecentSubscribers.',
  ),
  'channelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the subscriptions of the given channel owner.',
  ),
  'mySubscribers' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Return the subscribers of the given channel owner.',
  ),
  'forChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return the subscriptions to the subset of these channels that the authenticated user is subscribed to.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Return the subscriptions with the given IDs for Stubby or Apiary.',
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
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The order of the returned subscriptions',
    'enum' =>
    array (
      0 => 'subscriptionOrderUnspecified',
      1 => 'relevance',
      2 => 'unread',
      3 => 'alphabetical',
    ),
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more subscription resource properties that the API response will include. If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a subscription resource, the snippet property contains other properties, such as a display title for the subscription. If you set *part=snippet*, the API response will also contain all of those nested properties.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'mine' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Flag for returning the subscriptions of the authenticated user.',
  ),
  'myRecentSubscribers' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `myRecentSubscribers`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/subscriptions';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'channelId',
  1 => 'mySubscribers',
  2 => 'forChannelId',
  3 => 'pageToken',
  4 => 'maxResults',
  5 => 'id',
  6 => 'onBehalfOfContentOwner',
  7 => 'onBehalfOfContentOwnerChannel',
  8 => 'order',
  9 => 'part',
  10 => 'mine',
  11 => 'myRecentSubscribers',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Comment Threads List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/commentThreads.
 */
class YouTubeCommentThreadsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_comment_threads_list';
    protected const DESCRIPTION = 'Comment Threads List

Official YouTube Data API endpoint: GET /youtube/v3/commentThreads
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: channelId, moderationStatus, allThreadsRelatedToChannelId, postId, id, searchTerms, textFormat, pageToken, maxResults, videoId, order, part.',
  ),
  'channelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Returns the comment threads for all the channel comments (ie does not include comments left on videos).',
  ),
  'moderationStatus' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Limits the returned comment threads to those with the specified moderation status. Not compatible with the \'id\' filter. Valid values: published, heldForReview, likelySpam.',
    'enum' =>
    array (
      0 => 'published',
      1 => 'heldForReview',
      2 => 'likelySpam',
      3 => 'rejected',
    ),
  ),
  'allThreadsRelatedToChannelId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Returns the comment threads of all videos of the channel and the channel comments as well.',
  ),
  'postId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Returns the comment threads of the specified post.',
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Returns the comment threads with the given IDs for Stubby or Apiary.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'searchTerms' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Limits the returned comment threads to those matching the specified key words. Not compatible with the \'id\' filter.',
  ),
  'textFormat' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The requested text format for the returned comments.',
    'enum' =>
    array (
      0 => 'textFormatUnspecified',
      1 => 'html',
      2 => 'plainText',
    ),
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
  'videoId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Returns the comment threads of the specified video.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `order`.',
    'enum' =>
    array (
      0 => 'orderUnspecified',
      1 => 'time',
      2 => 'relevance',
    ),
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies a comma-separated list of one or more commentThread resource properties that the API response will include.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/commentThreads';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'channelId',
  1 => 'moderationStatus',
  2 => 'allThreadsRelatedToChannelId',
  3 => 'postId',
  4 => 'id',
  5 => 'searchTerms',
  6 => 'textFormat',
  7 => 'pageToken',
  8 => 'maxResults',
  9 => 'videoId',
  10 => 'order',
  11 => 'part',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}

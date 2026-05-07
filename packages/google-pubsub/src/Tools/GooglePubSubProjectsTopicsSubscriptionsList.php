<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Subscriptions List.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+topic}/subscriptions.
 */
class GooglePubSubProjectsTopicsSubscriptionsList extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_subscriptions_list';
    protected const DESCRIPTION = 'Projects Topics Subscriptions List

Official Pub/Sub endpoint: GET /v1/{+topic}/subscriptions
Lists the names of the attached subscriptions on this topic.';
    protected const PARAMETERS = array (
  'topic' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `topic`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+topic}/subscriptions';
    protected const PATH_PARAMS = array (
  0 => 'topic',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'topic',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}

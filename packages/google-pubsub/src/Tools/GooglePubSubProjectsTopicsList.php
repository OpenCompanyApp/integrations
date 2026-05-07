<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics List.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+project}/topics.
 */
class GooglePubSubProjectsTopicsList extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_list';
    protected const DESCRIPTION = 'Projects Topics List

Official Pub/Sub endpoint: GET /v1/{+project}/topics
Lists matching topics.';
    protected const PARAMETERS = array (
  'project' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `project`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
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
    protected const PATH = '/v1/{+project}/topics';
    protected const PATH_PARAMS = array (
  0 => 'project',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'project',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}

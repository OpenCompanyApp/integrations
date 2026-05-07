<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Publish.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+topic}:publish.
 */
class GooglePubSubProjectsTopicsPublish extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_publish';
    protected const DESCRIPTION = 'Projects Topics Publish

Official Pub/Sub endpoint: POST /v1/{+topic}:publish
Adds one or more messages to the topic. Returns `NOT_FOUND` if the topic does not exist.';
    protected const PARAMETERS = array (
  'topic' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `topic`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `PublishRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+topic}:publish';
    protected const PATH_PARAMS = array (
  0 => 'topic',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'topic',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}

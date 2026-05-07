<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Get.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+topic}.
 */
class GooglePubSubProjectsTopicsGet extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_get';
    protected const DESCRIPTION = 'Projects Topics Get

Official Pub/Sub endpoint: GET /v1/{+topic}
Gets the configuration of a topic.';
    protected const PARAMETERS = array (
  'topic' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `topic`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+topic}';
    protected const PATH_PARAMS = array (
  0 => 'topic',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'topic',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}

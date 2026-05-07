<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Create.
 *
 * Maps to the official Pub/Sub endpoint PUT /v1/{+name}.
 */
class GooglePubSubProjectsTopicsCreate extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_create';
    protected const DESCRIPTION = 'Projects Topics Create

Official Pub/Sub endpoint: PUT /v1/{+name}
Creates the given topic with the given name. See the [resource name rules] (https://cloud.google.com/pubsub/docs/pubsub-basics#resource_names).';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `Topic` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}

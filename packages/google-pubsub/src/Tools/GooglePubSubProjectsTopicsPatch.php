<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Patch.
 *
 * Maps to the official Pub/Sub endpoint PATCH /v1/{+name}.
 */
class GooglePubSubProjectsTopicsPatch extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_patch';
    protected const DESCRIPTION = 'Projects Topics Patch

Official Pub/Sub endpoint: PATCH /v1/{+name}
Updates an existing topic by updating the fields specified in the update mask. Note that certain properties of a topic are not modifiable.';
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
    'description' => 'JSON request body matching the official Pub/Sub `UpdateTopicRequest` schema.',
  ),
);
    protected const METHOD = 'PATCH';
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

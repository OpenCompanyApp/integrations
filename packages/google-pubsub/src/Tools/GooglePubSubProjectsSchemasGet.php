<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Get.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+name}.
 */
class GooglePubSubProjectsSchemasGet extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_get';
    protected const DESCRIPTION = 'Projects Schemas Get

Official Pub/Sub endpoint: GET /v1/{+name}
Gets a schema.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: view.',
  ),
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'view',
);
    protected const BODY_REQUIRED = false;
}

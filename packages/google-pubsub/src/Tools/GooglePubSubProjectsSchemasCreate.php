<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Create.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+parent}/schemas.
 */
class GooglePubSubProjectsSchemasCreate extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_create';
    protected const DESCRIPTION = 'Projects Schemas Create

Official Pub/Sub endpoint: POST /v1/{+parent}/schemas
Creates a schema.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: schemaId.',
  ),
  'schemaId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `schemaId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `Schema` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/schemas';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'schemaId',
);
    protected const BODY_REQUIRED = true;
}

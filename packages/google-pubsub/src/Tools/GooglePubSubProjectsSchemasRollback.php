<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Rollback.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+name}:rollback.
 */
class GooglePubSubProjectsSchemasRollback extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_rollback';
    protected const DESCRIPTION = 'Projects Schemas Rollback

Official Pub/Sub endpoint: POST /v1/{+name}:rollback
Creates a new schema revision that is a copy of the provided revision_id.';
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
    'description' => 'JSON request body matching the official Pub/Sub `RollbackSchemaRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:rollback';
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

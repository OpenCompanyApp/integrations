<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Commit.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+name}:commit.
 */
class GooglePubSubProjectsSchemasCommit extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_commit';
    protected const DESCRIPTION = 'Projects Schemas Commit

Official Pub/Sub endpoint: POST /v1/{+name}:commit
Commits a new schema revision to an existing schema.';
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
    'description' => 'JSON request body matching the official Pub/Sub `CommitSchemaRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:commit';
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

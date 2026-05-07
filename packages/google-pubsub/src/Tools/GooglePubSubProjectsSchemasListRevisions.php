<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas List Revisions.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+name}:listRevisions.
 */
class GooglePubSubProjectsSchemasListRevisions extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_list_revisions';
    protected const DESCRIPTION = 'Projects Schemas List Revisions

Official Pub/Sub endpoint: GET /v1/{+name}:listRevisions
Lists all schema revisions for the named schema.';
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
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: view, pageSize, pageToken.',
  ),
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
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
    protected const PATH = '/v1/{+name}:listRevisions';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'view',
  1 => 'pageSize',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}

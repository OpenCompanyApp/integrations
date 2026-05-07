<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas List.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+parent}/schemas.
 */
class GooglePubSubProjectsSchemasList extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_list';
    protected const DESCRIPTION = 'Projects Schemas List

Official Pub/Sub endpoint: GET /v1/{+parent}/schemas
Lists schemas in a project.';
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
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: pageSize, pageToken, view.',
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
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/schemas';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'view',
);
    protected const BODY_REQUIRED = false;
}

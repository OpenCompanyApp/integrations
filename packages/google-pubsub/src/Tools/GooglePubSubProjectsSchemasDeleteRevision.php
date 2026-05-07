<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Delete Revision.
 *
 * Maps to the official Pub/Sub endpoint DELETE /v1/{+name}:deleteRevision.
 */
class GooglePubSubProjectsSchemasDeleteRevision extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_delete_revision';
    protected const DESCRIPTION = 'Projects Schemas Delete Revision

Official Pub/Sub endpoint: DELETE /v1/{+name}:deleteRevision
Deletes a specific schema revision.';
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
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: revisionId.',
  ),
  'revisionId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `revisionId`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}:deleteRevision';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'revisionId',
);
    protected const BODY_REQUIRED = false;
}

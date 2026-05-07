<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Schemas Delete.
 *
 * Maps to the official Pub/Sub endpoint DELETE /v1/{+name}.
 */
class GooglePubSubProjectsSchemasDelete extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_schemas_delete';
    protected const DESCRIPTION = 'Projects Schemas Delete

Official Pub/Sub endpoint: DELETE /v1/{+name}
Deletes a schema.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}

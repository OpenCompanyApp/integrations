<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an authorization resource.
 *
 * Maps to the official WorkOS endpoint delete /authorization/resources/{resource_id}.
 */
class WorkOSAuthorizationResourcesDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_delete';
    protected const DESCRIPTION = 'Delete an authorization resource

Official WorkOS endpoint: DELETE /authorization/resources/{resource_id}

Delete an authorization resource and all its descendants.';
    protected const PARAMETERS = array (
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource_id` from the official WorkOS API operation.',
  ),
  'cascade_delete' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `cascade_delete` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/authorization/resources/{resource_id}';
    protected const PATH_PARAMS = array (
  'resource_id' => 'resource_id',
);
    protected const QUERY_PARAMS = array (
  'cascade_delete' => 'cascade_delete',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

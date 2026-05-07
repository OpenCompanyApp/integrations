<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a resource.
 *
 * Maps to the official WorkOS endpoint patch /authorization/resources/{resource_id}.
 */
class WorkOSAuthorizationResourcesUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_update';
    protected const DESCRIPTION = 'Update a resource

Official WorkOS endpoint: PATCH /authorization/resources/{resource_id}

Update an existing authorization resource.';
    protected const PARAMETERS = array (
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource_id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/authorization/resources/{resource_id}';
    protected const PATH_PARAMS = array (
  'resource_id' => 'resource_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

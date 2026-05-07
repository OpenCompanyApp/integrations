<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a resource by external ID.
 *
 * Maps to the official WorkOS endpoint patch /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}.
 */
class WorkOSAuthorizationResourcesByExternalIdUpdateByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_by_external_id_update_by_external_id';
    protected const DESCRIPTION = 'Update a resource by external ID

Official WorkOS endpoint: PATCH /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}

Update an existing authorization resource using its external ID.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_id` from the official WorkOS API operation.',
  ),
  'resource_type_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource_type_slug` from the official WorkOS API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `external_id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}';
    protected const PATH_PARAMS = array (
  'organization_id' => 'organization_id',
  'resource_type_slug' => 'resource_type_slug',
  'external_id' => 'external_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a resource by external ID.
 *
 * Maps to the official WorkOS endpoint get /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}.
 */
class WorkOSAuthorizationResourcesByExternalIdGetByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_by_external_id_get_by_external_id';
    protected const DESCRIPTION = 'Get a resource by external ID

Official WorkOS endpoint: GET /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}

Retrieve the details of an authorization resource by its external ID, organization, and resource type. This is useful when you only have the external ID from your system and need to fetch the full resource details.';
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
);
    protected const METHOD = 'get';
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
    protected const BODY_REQUIRED = false;
}

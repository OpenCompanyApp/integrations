<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an authorization resource by external ID.
 *
 * Maps to the official WorkOS endpoint delete /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}.
 */
class WorkOSAuthorizationResourcesByExternalIdDeleteByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_by_external_id_delete_by_external_id';
    protected const DESCRIPTION = 'Delete an authorization resource by external ID

Official WorkOS endpoint: DELETE /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}

Delete an authorization resource by organization, resource type, and external ID. This also deletes all descendant resources.';
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
  'cascade_delete' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `cascade_delete` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}';
    protected const PATH_PARAMS = array (
  'organization_id' => 'organization_id',
  'resource_type_slug' => 'resource_type_slug',
  'external_id' => 'external_id',
);
    protected const QUERY_PARAMS = array (
  'cascade_delete' => 'cascade_delete',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

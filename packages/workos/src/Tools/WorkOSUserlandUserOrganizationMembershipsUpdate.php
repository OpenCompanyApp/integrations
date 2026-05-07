<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update an organization membership.
 *
 * Maps to the official WorkOS endpoint put /user_management/organization_memberships/{id}.
 */
class WorkOSUserlandUserOrganizationMembershipsUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_update';
    protected const DESCRIPTION = 'Update an organization membership

Official WorkOS endpoint: PUT /user_management/organization_memberships/{id}

Update the details of an existing organization membership.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/user_management/organization_memberships/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

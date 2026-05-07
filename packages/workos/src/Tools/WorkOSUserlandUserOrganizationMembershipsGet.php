<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an organization membership.
 *
 * Maps to the official WorkOS endpoint get /user_management/organization_memberships/{id}.
 */
class WorkOSUserlandUserOrganizationMembershipsGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_get';
    protected const DESCRIPTION = 'Get an organization membership

Official WorkOS endpoint: GET /user_management/organization_memberships/{id}

Get the details of an existing organization membership.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/organization_memberships/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

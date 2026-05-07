<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Deactivate an organization membership.
 *
 * Maps to the official WorkOS endpoint put /user_management/organization_memberships/{id}/deactivate.
 */
class WorkOSUserlandUserOrganizationMembershipsDeactivate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_deactivate';
    protected const DESCRIPTION = 'Deactivate an organization membership

Official WorkOS endpoint: PUT /user_management/organization_memberships/{id}/deactivate

Deactivates an `active` organization membership. Emits an [organization_membership.updated](/events/organization-membership) event upon successful deactivation. - Deactivating an `inactive` membership is a no-op and does not emit an event. - Deactivating a `pending` membership returns an error. This membership should be [deleted](/reference/authkit/organization-membership/delete) instead. See the [membership management documentation](/authkit/users-organizations/organizations/membership-management) for additional details.';
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
    'required' => false,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/user_management/organization_memberships/{id}/deactivate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

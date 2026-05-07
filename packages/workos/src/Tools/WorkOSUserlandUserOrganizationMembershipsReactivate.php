<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Reactivate an organization membership.
 *
 * Maps to the official WorkOS endpoint put /user_management/organization_memberships/{id}/reactivate.
 */
class WorkOSUserlandUserOrganizationMembershipsReactivate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_reactivate';
    protected const DESCRIPTION = 'Reactivate an organization membership

Official WorkOS endpoint: PUT /user_management/organization_memberships/{id}/reactivate

Reactivates an `inactive` organization membership, retaining the pre-existing role(s). Emits an [organization_membership.updated](/events/organization-membership) event upon successful reactivation. - Reactivating an `active` membership is a no-op and does not emit an event. - Reactivating a `pending` membership returns an error. The user needs to [accept the invitation](/authkit/invitations) instead. See the [membership management documentation](/authkit/users-organizations/organizations/membership-management) for additional details.';
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
    protected const PATH = '/user_management/organization_memberships/{id}/reactivate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

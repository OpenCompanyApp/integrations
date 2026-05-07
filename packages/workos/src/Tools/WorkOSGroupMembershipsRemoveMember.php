<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Remove a member from a Group.
 *
 * Maps to the official WorkOS endpoint delete /organizations/{organizationId}/groups/{groupId}/organization-memberships/{omId}.
 */
class WorkOSGroupMembershipsRemoveMember extends AbstractWorkOSTool
{
    protected const NAME = 'workos_group_memberships_remove_member';
    protected const DESCRIPTION = 'Remove a member from a Group

Official WorkOS endpoint: DELETE /organizations/{organizationId}/groups/{groupId}/organization-memberships/{omId}

Remove an organization membership from a group.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official WorkOS API operation.',
  ),
  'om_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `omId` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/organizations/{organizationId}/groups/{groupId}/organization-memberships/{omId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'groupId' => 'group_id',
  'omId' => 'om_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

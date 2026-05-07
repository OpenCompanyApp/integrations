<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a group.
 *
 * Maps to the official WorkOS endpoint delete /organizations/{organizationId}/groups/{groupId}.
 */
class WorkOSGroupsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_groups_delete';
    protected const DESCRIPTION = 'Delete a group

Official WorkOS endpoint: DELETE /organizations/{organizationId}/groups/{groupId}

Delete a group from an organization.';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/organizations/{organizationId}/groups/{groupId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

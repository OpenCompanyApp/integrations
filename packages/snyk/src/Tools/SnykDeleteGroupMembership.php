<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a membership from a group.
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/memberships/{membership_id}.
 */
class SnykDeleteGroupMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_group_membership';
    protected const DESCRIPTION = 'Delete a membership from a group

Official Snyk endpoint: DELETE /groups/{group_id}/memberships/{membership_id}

Deletes a membership from a group #### Required permissions - `Delete Group Memberships (group.membership.delete)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the group',
  ),
  'membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `membership_id` from the official Snyk API operation. The ID of the Group Membership',
  ),
  'cascade' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `cascade` from the official Snyk API operation. indicates whether to delete the child org memberships of the group membership.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/groups/{group_id}/memberships/{membership_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'membership_id' => 'membership_id',
);
    protected const QUERY_PARAMS = array (
  'cascade' => 'cascade',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

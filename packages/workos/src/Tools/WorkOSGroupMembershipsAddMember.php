<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Add a member to a Group.
 *
 * Maps to the official WorkOS endpoint post /organizations/{organizationId}/groups/{groupId}/organization-memberships.
 */
class WorkOSGroupMembershipsAddMember extends AbstractWorkOSTool
{
    protected const NAME = 'workos_group_memberships_add_member';
    protected const DESCRIPTION = 'Add a member to a Group

Official WorkOS endpoint: POST /organizations/{organizationId}/groups/{groupId}/organization-memberships

Add an organization membership to a group.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/organizations/{organizationId}/groups/{groupId}/organization-memberships';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

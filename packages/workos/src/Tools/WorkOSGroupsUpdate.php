<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a group.
 *
 * Maps to the official WorkOS endpoint patch /organizations/{organizationId}/groups/{groupId}.
 */
class WorkOSGroupsUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_groups_update';
    protected const DESCRIPTION = 'Update a group

Official WorkOS endpoint: PATCH /organizations/{organizationId}/groups/{groupId}

Update an existing group. Only the fields provided in the request body will be updated.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/organizations/{organizationId}/groups/{groupId}';
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

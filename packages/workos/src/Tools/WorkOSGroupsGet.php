<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a group.
 *
 * Maps to the official WorkOS endpoint get /organizations/{organizationId}/groups/{groupId}.
 */
class WorkOSGroupsGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_groups_get';
    protected const DESCRIPTION = 'Get a group

Official WorkOS endpoint: GET /organizations/{organizationId}/groups/{groupId}

Retrieve a group by its ID within an organization.';
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
    protected const METHOD = 'get';
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

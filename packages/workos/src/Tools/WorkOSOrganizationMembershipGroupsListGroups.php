<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List groups.
 *
 * Maps to the official WorkOS endpoint get /user_management/organization_memberships/{omId}/groups.
 */
class WorkOSOrganizationMembershipGroupsListGroups extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_membership_groups_list_groups';
    protected const DESCRIPTION = 'List groups

Official WorkOS endpoint: GET /user_management/organization_memberships/{omId}/groups

Get a list of groups that an organization membership belongs to.';
    protected const PARAMETERS = array (
  'om_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `omId` from the official WorkOS API operation.',
  ),
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/organization_memberships/{omId}/groups';
    protected const PATH_PARAMS = array (
  'omId' => 'om_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

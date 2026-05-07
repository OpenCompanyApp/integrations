<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a group.
 *
 * Maps to the official WorkOS endpoint post /organizations/{organizationId}/groups.
 */
class WorkOSGroupsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_groups_create';
    protected const DESCRIPTION = 'Create a group

Official WorkOS endpoint: POST /organizations/{organizationId}/groups

Create a new group within an organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/organizations/{organizationId}/groups';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

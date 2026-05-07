<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a org membership for a user with role.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/memberships/{membership_id}.
 */
class SnykUpdateOrgMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_membership';
    protected const DESCRIPTION = 'Update a org membership for a user with role

Official Snyk endpoint: PATCH /orgs/{org_id}/memberships/{membership_id}

Update a org membership for a user with role #### Required permissions - `Edit Organization Memberships (org.membership.edit)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org',
  ),
  'membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `membership_id` from the official Snyk API operation. The id of the org membership',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/memberships/{membership_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'membership_id' => 'membership_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

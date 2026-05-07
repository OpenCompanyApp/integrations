<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a org membership for a user with role.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/memberships.
 */
class SnykCreateOrgMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_org_membership';
    protected const DESCRIPTION = 'Create a org membership for a user with role

Official Snyk endpoint: POST /orgs/{org_id}/memberships

Create a org membership for a user with role #### Required permissions - `Add Organization Memberships (org.membership.add)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the org',
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
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/memberships';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

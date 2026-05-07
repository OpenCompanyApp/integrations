<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateOrgToken.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/tokens.
 */
class PulumiOrganizationsCreateOrgToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_org_token';
    protected const DESCRIPTION = 'CreateOrgToken

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/tokens

Generates a new access token scoped to the organization for use in CI/CD pipelines and automated workflows. Organization tokens belong to the organization rather than individual users, ensuring that access is not disrupted when team members leave. The `name` field must be unique across the organization (including deleted tokens) and cannot exceed 40 characters. The `expires` field accepts a unix epoch timestamp up to two years from the present, or `0` for no expiry (default). **Important:** The token value in the response is only returned once at creation time and cannot be retrieved later. Audit logs for actions performed with organization tokens are attributed to the organization rather than an individual user.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'reason' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reason` from the official Pulumi Cloud API operation. Audit log reason for creating this token',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/tokens';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'reason' => 'reason',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

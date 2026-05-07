<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteOrgToken.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/tokens/{tokenId}.
 */
class PulumiOrganizationsDeleteOrgToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_org_token';
    protected const DESCRIPTION = 'DeleteOrgToken

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/tokens/{tokenId}

Permanently revokes and deletes an organization access token. Any CI/CD pipelines or automation using this token will immediately lose access to the organization\'s resources. This action cannot be undone.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tokenId` from the official Pulumi Cloud API operation. The access token identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/tokens/{tokenId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'tokenId' => 'token_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

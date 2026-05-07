<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOidcIssuer.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/oidc/issuers/{issuerId}.
 */
class PulumiOrganizationsUpdateOidcIssuer extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_oidc_issuer';
    protected const DESCRIPTION = 'UpdateOidcIssuer

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/oidc/issuers/{issuerId}

Updates an existing OIDC issuer registration for an organization. This can be used to modify the issuer name, audience restrictions, trust policies, or other configuration. The issuer URL itself cannot be changed after creation. The issuer name is required in the update request.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'issuer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `issuerId` from the official Pulumi Cloud API operation. The OIDC issuer identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/oidc/issuers/{issuerId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'issuerId' => 'issuer_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetAuthPolicy.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/auth/policies/oidcissuers/{issuerId}.
 */
class PulumiOrganizationsGetAuthPolicy extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_auth_policy';
    protected const DESCRIPTION = 'GetAuthPolicy

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/auth/policies/oidcissuers/{issuerId}

Returns the authentication policy associated with a specific OIDC issuer registration. Authentication policies define rules for how OIDC tokens from the issuer are validated and what access they grant, including claim mappings and trust conditions.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/auth/policies/oidcissuers/{issuerId}';
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

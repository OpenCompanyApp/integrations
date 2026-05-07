<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOidcIssuer.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/oidc/issuers/{issuerId}.
 */
class PulumiOrganizationsGetOidcIssuer extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_oidc_issuer';
    protected const DESCRIPTION = 'GetOidcIssuer

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/oidc/issuers/{issuerId}

Returns the details of a specific OIDC issuer registration, including the issuer URL, audience restrictions, TLS thumbprints, and trust policy configuration. OIDC issuer registrations establish trust relationships between the organization and external identity providers, enabling token exchange for temporary Pulumi Cloud credentials without storing long-lived secrets.';
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

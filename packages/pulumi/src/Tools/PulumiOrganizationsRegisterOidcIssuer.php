<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RegisterOidcIssuer.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/oidc/issuers.
 */
class PulumiOrganizationsRegisterOidcIssuer extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_register_oidc_issuer';
    protected const DESCRIPTION = 'RegisterOidcIssuer

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/oidc/issuers

Registers a new OIDC issuer for an organization, establishing a trust relationship with an external identity provider. Once registered, the identity provider can issue signed, short-lived tokens that are exchanged for temporary Pulumi Cloud credentials during deployments. This eliminates the need to store long-lived access tokens. Supported providers include AWS, Azure, Google Cloud, GitHub Actions, and any OIDC-compliant identity provider. The request must include the issuer URL, and the service will fetch the provider\'s public signing keys to verify token authenticity.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/oidc/issuers';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

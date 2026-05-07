<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * List.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/oidc/issuers.
 */
class PulumiOrganizationsListOrgsOidcIssuers extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_orgs_oidc_issuers';
    protected const DESCRIPTION = 'List

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/oidc/issuers

Returns all OIDC issuer registrations for an organization. OIDC issuer registrations establish trust relationships with external identity providers (such as AWS, Azure, Google Cloud, or GitHub Actions) to enable token exchange for temporary Pulumi Cloud credentials. This eliminates the need for long-lived access tokens in CI/CD pipelines and deployment automation.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
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

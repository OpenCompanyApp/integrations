<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetSAMLOrganization.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/saml.
 */
class PulumiOrganizationsGetSAMLOrganization extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_samlorganization';
    protected const DESCRIPTION = 'GetSAMLOrganization

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/saml

Returns the SAML configuration data for an organization, including the SSO endpoint URL, identity provider metadata, and SAML attribute mappings. SAML-backed organizations use an external identity provider for user authentication and can enforce single sign-on for all members.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/saml';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

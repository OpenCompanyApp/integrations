<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateSAMLOrganization.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/saml.
 */
class PulumiOrganizationsUpdateSAMLOrganization extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_samlorganization';
    protected const DESCRIPTION = 'UpdateSAMLOrganization

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/saml

Updates the SAML configuration for a SAML-backed organization, including the identity provider SSO descriptor, attribute mappings, and other SAML settings. The new IDP SSO descriptor is required in the update request.';
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
    protected const METHOD = 'patch';
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

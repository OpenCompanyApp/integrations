<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListSAMLOrganizationAdmins.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/saml/admins.
 */
class PulumiOrganizationsListSAMLOrganizationAdmins extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_samlorganization_admins';
    protected const DESCRIPTION = 'ListSAMLOrganizationAdmins

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/saml/admins

ListSAMLOrganizationAdmins returns the list of SAML admins for an organization. We currently only support one SAML admin per organization, where the SAML admin is the user who onboarded the organization to SAML.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/saml/admins';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

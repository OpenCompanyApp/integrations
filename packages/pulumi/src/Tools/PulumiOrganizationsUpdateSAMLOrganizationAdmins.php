<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateSAMLOrganizationAdmins.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/saml/admins/{userLogin}.
 */
class PulumiOrganizationsUpdateSAMLOrganizationAdmins extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_samlorganization_admins';
    protected const DESCRIPTION = 'UpdateSAMLOrganizationAdmins

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/saml/admins/{userLogin}

Updates the SAML admin for an organization. The SAML admin is the user who manages the SAML SSO configuration. Currently, each organization supports only one SAML admin (typically the user who onboarded the organization to SAML). The new admin must not belong to other organizations.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'user_login' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userLogin` from the official Pulumi Cloud API operation. The user login name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/saml/admins/{userLogin}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'userLogin' => 'user_login',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

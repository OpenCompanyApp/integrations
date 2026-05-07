<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DisableOrganizationKey.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/cmk/{keyID}/disable.
 */
class PulumiOrganizationsDisableOrganizationKey extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_disable_organization_key';
    protected const DESCRIPTION = 'DisableOrganizationKey

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/cmk/{keyID}/disable

Disables a specific customer managed key (CMK) for an organization. The key can no longer be used for encrypting new secrets, but existing secrets encrypted with this key remain accessible.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `keyID` from the official Pulumi Cloud API operation. The key identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/cmk/{keyID}/disable';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'keyID' => 'key_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

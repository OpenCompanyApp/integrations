<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * SetDefaultOrganizationKey.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/cmk/{keyID}/default.
 */
class PulumiOrganizationsSetDefaultOrganizationKey extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_set_default_organization_key';
    protected const DESCRIPTION = 'SetDefaultOrganizationKey

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/cmk/{keyID}/default

Sets a customer managed key as the default encryption key for the organization. New stacks created in the organization will use this key for encrypting secrets by default. The key must already be created and enabled for the organization.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/cmk/{keyID}/default';
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

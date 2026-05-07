<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}.
 */
class PulumiOrganizationsGetPolicyPack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_pack';
    protected const DESCRIPTION = 'GetPolicyPack

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}

Returns the metadata and list of individual policies for a specific version of a Policy Pack. Each policy includes its name, description, enforcement level (advisory, mandatory, or disabled), and configuration schema. Returns 400 if the Policy Pack version is not yet complete (still being uploaded), or 404 if the organization or pack is not found.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'policy_pack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policyPackName` from the official Pulumi Cloud API operation. The policy pack name',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The version number',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'policyPackName' => 'policy_pack_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

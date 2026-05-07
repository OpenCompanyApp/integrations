<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyPackConfigSchema.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}/schema.
 */
class PulumiOrganizationsGetPolicyPackConfigSchema extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_pack_config_schema';
    protected const DESCRIPTION = 'GetPolicyPackConfigSchema

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}/schema

Returns the JSON configuration schema for a specific version of a Policy Pack. The schema defines the configurable parameters for each policy in the pack, including allowed values, defaults, and validation rules. Policy Groups use this schema to configure policy behavior when assigning packs to stacks.';
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
    protected const PATH = '/api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}/schema';
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

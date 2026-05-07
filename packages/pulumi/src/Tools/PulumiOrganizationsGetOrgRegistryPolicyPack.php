<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrgRegistryPolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/registry/policypacks/{policyPackName}.
 */
class PulumiOrganizationsGetOrgRegistryPolicyPack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_org_registry_policy_pack';
    protected const DESCRIPTION = 'GetOrgRegistryPolicyPack

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/registry/policypacks/{policyPackName}

Retrieves lightweight registry metadata for a policy pack (source/publisher/name) without loading detailed policy definitions.';
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
  'tag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `tag` from the official Pulumi Cloud API operation. Version tag to retrieve (e.g., \'latest\')',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/registry/policypacks/{policyPackName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'policyPackName' => 'policy_pack_name',
);
    protected const QUERY_PARAMS = array (
  'tag' => 'tag',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

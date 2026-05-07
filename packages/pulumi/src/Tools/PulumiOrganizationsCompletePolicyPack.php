<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CompletePolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}/complete.
 */
class PulumiOrganizationsCompletePolicyPack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_complete_policy_pack';
    protected const DESCRIPTION = 'CompletePolicyPack

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}/complete

Transitions the publish status of a specific Policy Pack version to \'complete\', making it available for enforcement. Policy Packs go through a multi-step publish process: first the pack content is uploaded, then this endpoint is called to finalize publication. Returns 400 if the pack is already complete.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}/complete';
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

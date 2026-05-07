<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/policypacks/{policyPackName}.
 */
class PulumiOrganizationsDeletePolicyPackOrgsPolicypacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_policy_pack_orgs_policypacks';
    protected const DESCRIPTION = 'DeletePolicyPack

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/policypacks/{policyPackName}

DeletePolicyPack deletes all versions of a Policy Pack, the associated packs stored in S3, and any applied versions of the Policy Packs.';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/policypacks/{policyPackName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'policyPackName' => 'policy_pack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

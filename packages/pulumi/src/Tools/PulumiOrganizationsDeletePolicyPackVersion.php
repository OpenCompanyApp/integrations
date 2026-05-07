<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePolicyPackVersion.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}.
 */
class PulumiOrganizationsDeletePolicyPackVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_policy_pack_version';
    protected const DESCRIPTION = 'DeletePolicyPackVersion

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/policypacks/{policyPackName}/versions/{version}

DeletePolicyPackVersion deletes a specific version of a Policy Pack and deletes the associated pack stored in S3. A Policy Pack must be unapplied to be deleted.';
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
    protected const METHOD = 'delete';
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

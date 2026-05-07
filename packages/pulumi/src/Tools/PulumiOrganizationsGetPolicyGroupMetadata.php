<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyGroupMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policygroups/metadata.
 */
class PulumiOrganizationsGetPolicyGroupMetadata extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_group_metadata';
    protected const DESCRIPTION = 'GetPolicyGroupMetadata

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policygroups/metadata

Returns high-level policy protection metrics for an organization, including the number of stacks protected by policy enforcement, the total number of Policy Groups, and overall policy coverage statistics.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policygroups/metadata';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

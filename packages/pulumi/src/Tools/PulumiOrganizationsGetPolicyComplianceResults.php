<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyComplianceResults.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policyresults/compliance.
 */
class PulumiOrganizationsGetPolicyComplianceResults extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_compliance_results';
    protected const DESCRIPTION = 'GetPolicyComplianceResults

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policyresults/compliance

Returns compliance results for policy issues grouped by entity. The grouping can be by stack, cloud account, or severity, providing different views of the organization\'s policy compliance posture. This powers the compliance dashboard in the Pulumi Cloud console.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/policyresults/compliance';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

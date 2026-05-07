<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyViolationsV2.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policyresults/violationsv2.
 */
class PulumiOrganizationsListPolicyViolationsV2 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_policy_violations_v2';
    protected const DESCRIPTION = 'ListPolicyViolationsV2

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policyresults/violationsv2

ListPolicyViolationsV2Handler gets all the policy violations for an org. Deprecated: Use /policyresults/issues';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policyresults/violationsv2';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

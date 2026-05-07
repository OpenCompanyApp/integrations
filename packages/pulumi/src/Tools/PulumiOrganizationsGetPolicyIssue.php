<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyIssue.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policyresults/issues/{issueId}.
 */
class PulumiOrganizationsGetPolicyIssue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_issue';
    protected const DESCRIPTION = 'GetPolicyIssue

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policyresults/issues/{issueId}

Returns the details of a specific policy issue, including the violating resource, the policy pack and policy name that flagged the violation, the enforcement level (advisory or mandatory), severity, and the current triage status of the issue.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'issue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `issueId` from the official Pulumi Cloud API operation. The issue identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policyresults/issues/{issueId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'issueId' => 'issue_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

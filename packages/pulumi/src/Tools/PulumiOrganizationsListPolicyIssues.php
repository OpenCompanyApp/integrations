<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyIssues.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policyresults/issues.
 */
class PulumiOrganizationsListPolicyIssues extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_policy_issues';
    protected const DESCRIPTION = 'ListPolicyIssues

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policyresults/issues

Returns all policy issues for an organization with support for pagination and advanced filtering via the grid request format. Policy issues represent violations detected by Policy Packs during stack updates or continuous compliance scans. Each issue includes the violating resource, policy details, enforcement level (advisory or mandatory), severity, and triage status.';
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
    protected const PATH = '/api/orgs/{orgName}/policyresults/issues';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

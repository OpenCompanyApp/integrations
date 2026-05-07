<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyIssuesFilters.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policyresults/issues/filters.
 */
class PulumiOrganizationsGetPolicyIssuesFilters extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_issues_filters';
    protected const DESCRIPTION = 'GetPolicyIssuesFilters

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policyresults/issues/filters

Returns the available filter options for listing policy issues, such as policy pack names, enforcement levels, severity values, and resource types. This is used to populate filter dropdowns in the policy issues UI.';
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
    protected const PATH = '/api/orgs/{orgName}/policyresults/issues/filters';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

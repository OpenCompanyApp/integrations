<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPoliciesCompliance.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policyresults/policies.
 */
class PulumiOrganizationsListPoliciesCompliance extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_policies_compliance';
    protected const DESCRIPTION = 'ListPoliciesCompliance

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policyresults/policies

Returns policy compliance data grouped by policy pack and policy name, showing how many stacks are in compliance or violation for each individual policy rule. Supports pagination and filtering via the grid request format.';
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
    protected const PATH = '/api/orgs/{orgName}/policyresults/policies';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

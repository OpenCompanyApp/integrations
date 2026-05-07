<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyResultsMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policyresults/metadata.
 */
class PulumiOrganizationsGetPolicyResultsMetadata extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_results_metadata';
    protected const DESCRIPTION = 'GetPolicyResultsMetadata

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policyresults/metadata

Returns high-level policy compliance statistics for an organization, including total violation counts, breakdown by severity and enforcement level, and trends over time. This provides an overview of the organization\'s policy compliance posture.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policyresults/metadata';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * OrgDeploymentsMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/deployments/metadata.
 */
class PulumiDeploymentsOrgDeploymentsMetadata extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_org_deployments_metadata';
    protected const DESCRIPTION = 'OrgDeploymentsMetadata

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/deployments/metadata

Returns metadata about the organization\'s Pulumi Deployments state. The response includes the overall pause status, a list of individually paused stacks (as stack references like `project/stack`), the configured concurrency limit (maximum number of concurrent deployments), and deployment counts broken down by status (`notStarted`, `accepted`, `running`, `failed`, `succeeded`, `skipped`, and `total`). This endpoint is useful for monitoring deployment health and capacity across an organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/deployments/metadata';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

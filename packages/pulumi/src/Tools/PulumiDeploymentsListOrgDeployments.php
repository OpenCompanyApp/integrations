<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrgDeployments.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/deployments.
 */
class PulumiDeploymentsListOrgDeployments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_list_org_deployments';
    protected const DESCRIPTION = 'ListOrgDeployments

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/deployments

Returns a paginated list of all Pulumi Deployments executions across an organization, filtered to only include deployments for stacks the requesting user has access to. The response includes each deployment\'s ID, status, version, creation time, the requesting user, project and stack names, Pulumi operation type, job details, and associated update results. Use \'page\' (minimum 1, default 1) and \'pageSize\' (1-100, default 10) for pagination, \'sort\' to specify the sort field, and \'asc\' to control sort direction (default descending). The response also includes the total count of matching deployments.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `asc` from the official Pulumi Cloud API operation. Sort in ascending order when true (default false)',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page` from the official Pulumi Cloud API operation. Page number (min 1, default 1)',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `pageSize` from the official Pulumi Cloud API operation. Results per page (1-100, default 10)',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Pulumi Cloud API operation. Field to sort results by',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/deployments';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'asc' => 'asc',
  'page' => 'page',
  'pageSize' => 'page_size',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

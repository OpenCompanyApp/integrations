<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of test plans.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/plans.
 */
class AzureDevOpsTestPlanTestPlansList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_plans_list';
    protected const DESCRIPTION = 'Get a list of test plans

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/plans (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'owner' => ['type' => 'string', 'required' => false, 'description' => 'Filter for test plan by owner ID or name'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'If the list of plans returned is not complete, a continuation token to query next batch of plans is included in the response header as "x-ms-continuationtoken". Omit this parameter to get the first batch of test plans.'], 'include_plan_details' => ['type' => 'boolean', 'required' => false, 'description' => 'Get all properties of the test plan'], 'filter_active_plans' => ['type' => 'boolean', 'required' => false, 'description' => 'Get just the active plans'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/plans';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['owner' => 'owner', 'continuationToken' => 'continuation_token', 'includePlanDetails' => 'include_plan_details', 'filterActivePlans' => 'filter_active_plans', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

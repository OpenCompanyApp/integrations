<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Deleted Test Suites for a Test Plan..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/recycleBin/TestPlan/{planId}/testsuite.
 */
class AzureDevOpsTestPlanTestSuiteRecycleBinOperationsGetDeletedTestSuitesForPlan extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_suite_recycle_bin_operations_get_deleted_test_suites_for_plan';
    protected const DESCRIPTION = 'Get Deleted Test Suites for a Test Plan.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/recycleBin/TestPlan/{planId}/testsuite (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan for which suites are requested.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include the children suites and testers details.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'If the list of suites returned is not complete, a continuation token to query next batch of suites is included in the response header as "x-ms-continuationtoken". Omit this parameter to get the first batch of test suites.'], 'as_tree_view' => ['type' => 'boolean', 'required' => false, 'description' => 'If the suites returned should be in a tree structure.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/recycleBin/TestPlan/{planId}/testsuite';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id'];
    protected const QUERY_PARAMS = ['expand' => 'expand', 'continuationToken' => 'continuation_token', 'asTreeView' => 'as_tree_view', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

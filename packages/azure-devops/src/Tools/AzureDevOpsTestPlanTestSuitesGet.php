<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get test suite by suite id..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/suites/{suiteId}.
 */
class AzureDevOpsTestPlanTestSuitesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_suites_get';
    protected const DESCRIPTION = 'Get test suite by suite id.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/suites/{suiteId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan that contains the suites.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the suite to get.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include the children suites and testers details'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Plans/{planId}/suites/{suiteId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

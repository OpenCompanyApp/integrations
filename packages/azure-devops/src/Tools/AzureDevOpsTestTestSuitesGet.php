<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific test case in a test suite with test case id..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases/{testCaseIds}.
 */
class AzureDevOpsTestTestSuitesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_test_suites_get';
    protected const DESCRIPTION = 'Get a specific test case in a test suite with test case id.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases/{testCaseIds} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan that contains the suites.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the suite that contains the test case.'], 'test_case_ids' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test case to get.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases/{testCaseIds}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id', 'testCaseIds' => 'test_case_ids'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

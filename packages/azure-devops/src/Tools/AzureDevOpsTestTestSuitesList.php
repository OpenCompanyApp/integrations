<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all test cases in a suite..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases.
 */
class AzureDevOpsTestTestSuitesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_test_suites_list';
    protected const DESCRIPTION = 'Get all test cases in a suite.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan that contains the suites.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the suite to get.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates the properties of the test case association in a suite..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases/{testCaseIds}.
 */
class AzureDevOpsTestTestSuitesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_test_suites_update';
    protected const DESCRIPTION = 'Updates the properties of the test case association in a suite.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases/{testCaseIds} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Model for updation of the properties of test case suite association.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan that contains the suite.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test suite to which the test cases must be added.'], 'test_case_ids' => ['type' => 'string', 'required' => true, 'description' => 'IDs of the test cases to add to the suite. Ids are specified in comma separated format.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Plans/{planId}/suites/{suiteId}/testcases/{testCaseIds}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id', 'testCaseIds' => 'test_case_ids'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

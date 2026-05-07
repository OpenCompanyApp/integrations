<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a particular Test Case from a Suite..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase/{testCaseId}.
 */
class AzureDevOpsTestPlanSuiteTestCaseGetTestCase extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_suite_test_case_get_test_case';
    protected const DESCRIPTION = 'Get a particular Test Case from a Suite.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase/{testCaseId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan for which test cases are requested.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test suite for which test cases are requested.'], 'test_case_id' => ['type' => 'string', 'required' => true, 'description' => 'Test Case Id to be fetched.'], 'wit_fields' => ['type' => 'string', 'required' => false, 'description' => 'Get the list of witFields.'], 'return_identity_ref' => ['type' => 'boolean', 'required' => false, 'description' => 'If set to true, returns all identity fields, like AssignedTo, ActivatedBy etc., as IdentityRef objects. If set to false, these fields are returned as unique names in string format. This is false by default.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase/{testCaseId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id', 'testCaseId' => 'test_case_id'];
    protected const QUERY_PARAMS = ['witFields' => 'wit_fields', 'returnIdentityRef' => 'return_identity_ref', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

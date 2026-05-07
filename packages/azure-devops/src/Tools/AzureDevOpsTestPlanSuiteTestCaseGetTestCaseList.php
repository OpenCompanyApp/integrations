<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Test Case List return those test cases which have all the configuration Ids as mentioned in the optional parameter. If configuration Ids is null, it return all the test cases.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase.
 */
class AzureDevOpsTestPlanSuiteTestCaseGetTestCaseList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_suite_test_case_get_test_case_list';
    protected const DESCRIPTION = 'Get Test Case List return those test cases which have all the configuration Ids as mentioned in the optional parameter. If configuration Ids is null, it return all the test cases

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan for which test cases are requested.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test suite for which test cases are requested.'], 'test_ids' => ['type' => 'string', 'required' => false, 'description' => 'Test Case Ids to be fetched.'], 'configuration_ids' => ['type' => 'string', 'required' => false, 'description' => 'Fetch Test Cases which contains all the configuration Ids specified.'], 'wit_fields' => ['type' => 'string', 'required' => false, 'description' => 'Get the list of witFields.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'If the list of test cases returned is not complete, a continuation token to query next batch of test cases is included in the response header as "x-ms-continuationtoken". Omit this parameter to get the first batch of test cases.'], 'return_identity_ref' => ['type' => 'boolean', 'required' => false, 'description' => 'If set to true, returns all identity fields, like AssignedTo, ActivatedBy etc., as IdentityRef objects. If set to false, these fields are returned as unique names in string format. This is false by default.'], 'expand' => ['type' => 'boolean', 'required' => false, 'description' => 'If set to false, will get a smaller payload containing only basic details about the suite test case object'], 'exclude_flags' => ['type' => 'string', 'required' => false, 'description' => 'Flag to exclude various values from payload. For example to remove point assignments pass exclude = 1. To remove extra information (links, test plan , test suite) pass exclude = 2. To remove both extra information and point assignments pass exclude = 3 (1 + 2).'], 'is_recursive' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `isRecursive`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['testIds' => 'test_ids', 'configurationIds' => 'configuration_ids', 'witFields' => 'wit_fields', 'continuationToken' => 'continuation_token', 'returnIdentityRef' => 'return_identity_ref', 'expand' => 'expand', 'excludeFlags' => 'exclude_flags', 'isRecursive' => 'is_recursive', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

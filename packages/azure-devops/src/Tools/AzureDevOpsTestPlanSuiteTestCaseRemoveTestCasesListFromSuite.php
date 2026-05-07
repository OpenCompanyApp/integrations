<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes test cases from a suite based on the list of test case Ids provided. This API can be used to remove a larger number of test cases..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase.
 */
class AzureDevOpsTestPlanSuiteTestCaseRemoveTestCasesListFromSuite extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_suite_test_case_remove_test_cases_list_from_suite';
    protected const DESCRIPTION = 'Removes test cases from a suite based on the list of test case Ids provided. This API can be used to remove a larger number of test cases.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan from which test cases are to be removed.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test suite from which test cases are to be removed.'], 'test_ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma separated string of Test Case Ids to be removed.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestCase';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['testIds' => 'test_ids', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

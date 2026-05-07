<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a test case..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/testplan/testcases/{testCaseId}.
 */
class AzureDevOpsTestPlanTestCasesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_cases_delete';
    protected const DESCRIPTION = 'Delete a test case.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/testplan/testcases/{testCaseId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_case_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of test case to be deleted.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/testcases/{testCaseId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'testCaseId' => 'test_case_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get clone information..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/TestCases/CloneTestCaseOperation/{cloneOperationId}.
 */
class AzureDevOpsTestPlanTestCaseCloneGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_case_clone_get';
    protected const DESCRIPTION = 'Get clone information.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/TestCases/CloneTestCaseOperation/{cloneOperationId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'clone_operation_id' => ['type' => 'number', 'required' => true, 'description' => 'Operation ID returned when we queue a clone operation'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/TestCases/CloneTestCaseOperation/{cloneOperationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'cloneOperationId' => 'clone_operation_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

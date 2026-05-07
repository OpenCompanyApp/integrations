<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Clone test suite.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/testplan/Suites/CloneOperation.
 */
class AzureDevOpsTestPlanTestSuiteCloneCloneTestSuite extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_suite_clone_clone_test_suite';
    protected const DESCRIPTION = 'Clone test suite

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/testplan/Suites/CloneOperation (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Suite Clone Request Body detail TestSuiteCloneRequest'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'deep_clone' => ['type' => 'boolean', 'required' => false, 'description' => 'Clones all the associated test cases as well'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Suites/CloneOperation';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['deepClone' => 'deep_clone', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a test variable by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/variables/{testVariableId}.
 */
class AzureDevOpsTestPlanVariablesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_variables_update';
    protected const DESCRIPTION = 'Update a test variable by its ID.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/variables/{testVariableId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'TestVariableCreateUpdateParameters'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_variable_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test variable to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/variables/{testVariableId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'testVariableId' => 'test_variable_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a test configuration by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/testplan/configurations.
 */
class AzureDevOpsTestPlanConfigurationsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_configurations_delete';
    protected const DESCRIPTION = 'Delete a test configuration by its ID.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/testplan/configurations (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_configuartion_id' => ['type' => 'number', 'required' => false, 'description' => 'ID of the test configuration to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/configurations';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['testConfiguartionId' => 'test_configuartion_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

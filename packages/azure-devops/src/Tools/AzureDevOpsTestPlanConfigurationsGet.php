<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a test configuration.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/testplan/configurations/{testConfigurationId}.
 */
class AzureDevOpsTestPlanConfigurationsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_configurations_get';
    protected const DESCRIPTION = 'Get a test configuration

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/testplan/configurations/{testConfigurationId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_configuration_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test configuration to get.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/configurations/{testConfigurationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'testConfigurationId' => 'test_configuration_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

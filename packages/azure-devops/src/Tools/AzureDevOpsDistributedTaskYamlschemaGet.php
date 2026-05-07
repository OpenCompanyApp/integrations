<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET the Yaml schema used for Yaml file validation..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/yamlschema.
 */
class AzureDevOpsDistributedTaskYamlschemaGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_yamlschema_get';
    protected const DESCRIPTION = 'GET the Yaml schema used for Yaml file validation.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/yamlschema (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'validate_task_names' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether the schema should validate that tasks are actually installed (useful for offline tools where you don\'t want validation).'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/yamlschema';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['validateTaskNames' => 'validate_task_names', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

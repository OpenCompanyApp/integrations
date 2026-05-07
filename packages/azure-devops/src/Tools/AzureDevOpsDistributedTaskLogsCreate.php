<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a log and connect it to a pipeline run's execution plan..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/logs.
 */
class AzureDevOpsDistributedTaskLogsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_logs_create';
    protected const DESCRIPTION = 'Create a log and connect it to a pipeline run\'s execution plan.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/logs (spec: distributedTask/7.2/task.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'An object that contains information about log\'s path.'], 'scope_identifier' => ['type' => 'string', 'required' => true, 'description' => 'The project GUID to scope the request'], 'hub_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the server hub. Common examples: "build", "rm", "checks"'], 'plan_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the plan.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/logs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'scopeIdentifier' => 'scope_identifier', 'hubName' => 'hub_name', 'planId' => 'plan_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

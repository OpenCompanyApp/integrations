<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Append a log to a task's log. The log should be sent in the body of the request as a TaskLog object stream..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/logs/{logId}.
 */
class AzureDevOpsDistributedTaskLogsAppendLogContent extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_logs_append_log_content';
    protected const DESCRIPTION = 'Append a log to a task\'s log. The log should be sent in the body of the request as a TaskLog object stream.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/logs/{logId} (spec: distributedTask/7.2/task.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw payload: provide `content` as a string and optional `content_type`.'], 'scope_identifier' => ['type' => 'string', 'required' => true, 'description' => 'The project GUID to scope the request'], 'hub_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the server hub. Common examples: "build", "rm", "checks"'], 'plan_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the plan.'], 'log_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the log.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/logs/{logId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'scopeIdentifier' => 'scope_identifier', 'hubName' => 'hub_name', 'planId' => 'plan_id', 'logId' => 'log_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'octet';
    protected const API_VERSION = '7.2-preview.1';
}

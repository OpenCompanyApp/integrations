<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * POST /{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/jobs/{jobId}/oidctoken.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/jobs/{jobId}/oidctoken.
 */
class AzureDevOpsDistributedTaskOidctokenCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_oidctoken_create';
    protected const DESCRIPTION = 'POST /{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/jobs/{jobId}/oidctoken

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/jobs/{jobId}/oidctoken (spec: distributedTask/7.2/task.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'scope_identifier' => ['type' => 'string', 'required' => true, 'description' => 'The project GUID to scope the request'], 'hub_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the server hub. Common examples: "build", "rm", "checks"'], 'plan_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `planId`.'], 'job_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `jobId`.'], 'service_connection_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `serviceConnectionId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{scopeIdentifier}/_apis/distributedtask/hubs/{hubName}/plans/{planId}/jobs/{jobId}/oidctoken';
    protected const PATH_PARAMS = ['organization' => 'organization', 'scopeIdentifier' => 'scope_identifier', 'hubName' => 'hub_name', 'planId' => 'plan_id', 'jobId' => 'job_id'];
    protected const QUERY_PARAMS = ['serviceConnectionId' => 'service_connection_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

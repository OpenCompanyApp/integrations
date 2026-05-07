<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Triggers a pipeline run of pipelines which have a webhook resource defined with specified WebHook Name property of the WebHook service connection..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/public/distributedtask/webhooks/{webHookId}.
 */
class AzureDevOpsDistributedTaskWebhooksReceiveExternalEvent extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_webhooks_receive_external_event';
    protected const DESCRIPTION = 'Triggers a pipeline run of pipelines which have a webhook resource defined with specified WebHook Name property of the WebHook service connection.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/public/distributedtask/webhooks/{webHookId} (spec: distributedTask/7.2/task.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'web_hook_id' => ['type' => 'string', 'required' => true, 'description' => 'The WebHook Name property of the WebHook service connection'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/public/distributedtask/webhooks/{webHookId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'webHookId' => 'web_hook_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

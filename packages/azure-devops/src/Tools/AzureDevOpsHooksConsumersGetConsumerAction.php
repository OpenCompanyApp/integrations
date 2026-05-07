<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get details about a specific consumer action..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/consumers/{consumerId}/actions/{consumerActionId}.
 */
class AzureDevOpsHooksConsumersGetConsumerAction extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_consumers_get_consumer_action';
    protected const DESCRIPTION = 'Get details about a specific consumer action.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/consumers/{consumerId}/actions/{consumerActionId} (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'consumer_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a consumer.'], 'consumer_action_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a consumerActionId.'], 'publisher_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `publisherId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/consumers/{consumerId}/actions/{consumerActionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'consumerId' => 'consumer_id', 'consumerActionId' => 'consumer_action_id'];
    protected const QUERY_PARAMS = ['publisherId' => 'publisher_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

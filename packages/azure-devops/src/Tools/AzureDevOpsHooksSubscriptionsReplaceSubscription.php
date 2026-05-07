<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a subscription. <param name="subscriptionId">ID for a subscription that you wish to update.</param>.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}.
 */
class AzureDevOpsHooksSubscriptionsReplaceSubscription extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_subscriptions_replace_subscription';
    protected const DESCRIPTION = 'Update a subscription. <param name="subscriptionId">ID for a subscription that you wish to update.</param>

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId} (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subscriptionId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/subscriptions/{subscriptionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subscriptionId' => 'subscription_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

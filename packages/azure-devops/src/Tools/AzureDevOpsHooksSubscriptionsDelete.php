<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a specific service hooks subscription..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}.
 */
class AzureDevOpsHooksSubscriptionsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_subscriptions_delete';
    protected const DESCRIPTION = 'Delete a specific service hooks subscription.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId} (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a subscription.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/subscriptions/{subscriptionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subscriptionId' => 'subscription_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

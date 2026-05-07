<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a subscription..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/hooks/subscriptions.
 */
class AzureDevOpsHooksSubscriptionsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_subscriptions_create';
    protected const DESCRIPTION = 'Create a subscription.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/hooks/subscriptions (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Subscription to be created.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/subscriptions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

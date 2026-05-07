<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/hooks/subscriptions/{subscriptionId}/diagnostics.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}/diagnostics.
 */
class AzureDevOpsHooksDiagnosticsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_diagnostics_get';
    protected const DESCRIPTION = 'GET /{organization}/_apis/hooks/subscriptions/{subscriptionId}/diagnostics

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}/diagnostics (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subscriptionId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/subscriptions/{subscriptionId}/diagnostics';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subscriptionId' => 'subscription_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

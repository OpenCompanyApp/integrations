<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Sends a test notification. This is useful for verifying the configuration of an updated or new service hooks subscription..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/hooks/testnotifications.
 */
class AzureDevOpsHooksNotificationsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_notifications_create';
    protected const DESCRIPTION = 'Sends a test notification. This is useful for verifying the configuration of an updated or new service hooks subscription.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/hooks/testnotifications (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'use_real_data' => ['type' => 'boolean', 'required' => false, 'description' => 'Only allow testing with real data in existing subscriptions.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/testnotifications';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['useRealData' => 'use_real_data', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

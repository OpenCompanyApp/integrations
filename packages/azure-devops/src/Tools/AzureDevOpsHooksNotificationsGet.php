<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific notification for a subscription..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}/notifications/{notificationId}.
 */
class AzureDevOpsHooksNotificationsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_notifications_get';
    protected const DESCRIPTION = 'Get a specific notification for a subscription.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}/notifications/{notificationId} (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a subscription.'], 'notification_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `notificationId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/subscriptions/{subscriptionId}/notifications/{notificationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subscriptionId' => 'subscription_id', 'notificationId' => 'notification_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

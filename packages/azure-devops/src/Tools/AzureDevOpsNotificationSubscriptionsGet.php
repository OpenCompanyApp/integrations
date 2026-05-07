<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a notification subscription by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions/{subscriptionId}.
 */
class AzureDevOpsNotificationSubscriptionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscriptions_get';
    protected const DESCRIPTION = 'Get a notification subscription by its ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions/{subscriptionId} (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subscriptionId`.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'query_flags' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `queryFlags`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscriptions/{subscriptionId}';
    protected const PATH_PARAMS = ['subscriptionId' => 'subscription_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['queryFlags' => 'query_flags', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

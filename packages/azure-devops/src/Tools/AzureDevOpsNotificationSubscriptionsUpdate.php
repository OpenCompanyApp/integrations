<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update an existing subscription. Depending on the type of subscription and permissions, the caller can update the description, filter settings, channel (delivery) settings and more..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions/{subscriptionId}.
 */
class AzureDevOpsNotificationSubscriptionsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscriptions_update';
    protected const DESCRIPTION = 'Update an existing subscription. Depending on the type of subscription and permissions, the caller can update the description, filter settings, channel (delivery) settings and more.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions/{subscriptionId} (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subscriptionId`.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscriptions/{subscriptionId}';
    protected const PATH_PARAMS = ['subscriptionId' => 'subscription_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

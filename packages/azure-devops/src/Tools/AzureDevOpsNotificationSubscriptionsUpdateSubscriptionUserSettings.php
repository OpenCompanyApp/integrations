<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the specified user's settings for the specified subscription. This API is typically used to opt in or out of a shared subscription. User settings can only be applied to shared subscriptions, like team subscriptions or default subscriptions..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://{service}dev.azure.com/{organization}/_apis/notification/Subscriptions/{subscriptionId}/usersettings/{userId}.
 */
class AzureDevOpsNotificationSubscriptionsUpdateSubscriptionUserSettings extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscriptions_update_subscription_user_settings';
    protected const DESCRIPTION = 'Update the specified user\'s settings for the specified subscription. This API is typically used to opt in or out of a shared subscription. User settings can only be applied to shared subscriptions, like team subscriptions or default subscriptions.

Official Azure DevOps REST API 7.2 endpoint: PUT https://{service}dev.azure.com/{organization}/_apis/notification/Subscriptions/{subscriptionId}/usersettings/{userId} (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subscriptionId`.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the user'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/Subscriptions/{subscriptionId}/usersettings/{userId}';
    protected const PATH_PARAMS = ['subscriptionId' => 'subscription_id', 'userId' => 'user_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get available subscription templates..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://{service}dev.azure.com/{organization}/_apis/notification/subscriptiontemplates.
 */
class AzureDevOpsNotificationSubscriptionsGetSubscriptionTemplates extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscriptions_get_subscription_templates';
    protected const DESCRIPTION = 'Get available subscription templates.

Official Azure DevOps REST API 7.2 endpoint: GET https://{service}dev.azure.com/{organization}/_apis/notification/subscriptiontemplates (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscriptiontemplates';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

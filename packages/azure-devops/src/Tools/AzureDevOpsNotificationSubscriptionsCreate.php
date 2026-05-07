<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a new subscription..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions.
 */
class AzureDevOpsNotificationSubscriptionsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscriptions_create';
    protected const DESCRIPTION = 'Create a new subscription.

Official Azure DevOps REST API 7.2 endpoint: POST https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscriptions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get delivery preferences of a notifications subscriber..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://{service}dev.azure.com/{organization}/_apis/notification/subscribers/{subscriberId}.
 */
class AzureDevOpsNotificationSubscribersGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscribers_get';
    protected const DESCRIPTION = 'Get delivery preferences of a notifications subscriber.

Official Azure DevOps REST API 7.2 endpoint: GET https://{service}dev.azure.com/{organization}/_apis/notification/subscribers/{subscriberId} (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the user or group.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscribers/{subscriberId}';
    protected const PATH_PARAMS = ['subscriberId' => 'subscriber_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

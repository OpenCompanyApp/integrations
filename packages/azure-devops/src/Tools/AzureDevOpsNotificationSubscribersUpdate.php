<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update delivery preferences of a notifications subscriber..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://{service}dev.azure.com/{organization}/_apis/notification/subscribers/{subscriberId}.
 */
class AzureDevOpsNotificationSubscribersUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscribers_update';
    protected const DESCRIPTION = 'Update delivery preferences of a notifications subscriber.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://{service}dev.azure.com/{organization}/_apis/notification/subscribers/{subscriberId} (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the user or group.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscribers/{subscriberId}';
    protected const PATH_PARAMS = ['subscriberId' => 'subscriber_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

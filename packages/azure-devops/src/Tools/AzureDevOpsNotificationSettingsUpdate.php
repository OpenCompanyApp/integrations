<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * PATCH /{organization}/_apis/notification/settings.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://{service}dev.azure.com/{organization}/_apis/notification/settings.
 */
class AzureDevOpsNotificationSettingsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_settings_update';
    protected const DESCRIPTION = 'PATCH /{organization}/_apis/notification/settings

Official Azure DevOps REST API 7.2 endpoint: PATCH https://{service}dev.azure.com/{organization}/_apis/notification/settings (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/settings';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

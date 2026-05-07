<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * List available event types for this service. Optionally filter by only event types for the specified publisher..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://{service}dev.azure.com/{organization}/_apis/notification/eventtypes.
 */
class AzureDevOpsNotificationEventTypesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_event_types_list';
    protected const DESCRIPTION = 'List available event types for this service. Optionally filter by only event types for the specified publisher.

Official Azure DevOps REST API 7.2 endpoint: GET https://{service}dev.azure.com/{organization}/_apis/notification/eventtypes (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_id' => ['type' => 'string', 'required' => false, 'description' => 'Limit to event types for this publisher'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/eventtypes';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['publisherId' => 'publisher_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

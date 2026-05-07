<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of notifications for a specific subscription. A notification includes details about the event, the request to and the response from the consumer service..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}/notifications.
 */
class AzureDevOpsHooksNotificationsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_hooks_notifications_list';
    protected const DESCRIPTION = 'Get a list of notifications for a specific subscription. A notification includes details about the event, the request to and the response from the consumer service.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/hooks/subscriptions/{subscriptionId}/notifications (spec: hooks/7.2/serviceHooks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a subscription.'], 'max_results' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of notifications to return. Default is **100**.'], 'status' => ['type' => 'string', 'required' => false, 'description' => 'Get only notifications with this status.'], 'result' => ['type' => 'string', 'required' => false, 'description' => 'Get only notifications with this result type.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/hooks/subscriptions/{subscriptionId}/notifications';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subscriptionId' => 'subscription_id'];
    protected const QUERY_PARAMS = ['maxResults' => 'max_results', 'status' => 'status', 'result' => 'result', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

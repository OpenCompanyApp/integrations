<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of notification subscriptions, either by subscription IDs or by all subscriptions for a given user or group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions.
 */
class AzureDevOpsNotificationSubscriptionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_subscriptions_list';
    protected const DESCRIPTION = 'Get a list of notification subscriptions, either by subscription IDs or by all subscriptions for a given user or group.

Official Azure DevOps REST API 7.2 endpoint: GET https://{service}dev.azure.com/{organization}/_apis/notification/subscriptions (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'target_id' => ['type' => 'string', 'required' => false, 'description' => 'User or Group ID'], 'ids' => ['type' => 'string', 'required' => false, 'description' => 'List of subscription IDs'], 'query_flags' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `queryFlags`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/subscriptions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['targetId' => 'target_id', 'ids' => 'ids', 'queryFlags' => 'query_flags', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of diagnostic logs for this service..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://{service}dev.azure.com/{organization}/_apis/notification/diagnosticlogs/{source}/entries/{entryId}.
 */
class AzureDevOpsNotificationDiagnosticLogsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_notification_diagnostic_logs_list';
    protected const DESCRIPTION = 'Get a list of diagnostic logs for this service.

Official Azure DevOps REST API 7.2 endpoint: GET https://{service}dev.azure.com/{organization}/_apis/notification/diagnosticlogs/{source}/entries/{entryId} (spec: notification/7.2/notification.json).';
    protected const PARAMETERS = ['source' => ['type' => 'string', 'required' => true, 'description' => 'ID specifying which type of logs to check diagnostics for.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the specific log to query for.'], 'start_time' => ['type' => 'string', 'required' => false, 'description' => 'Start time for the time range to query in.'], 'end_time' => ['type' => 'string', 'required' => false, 'description' => 'End time for the time range to query in.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = '{service}dev.azure.com';
    protected const PATH = '/{organization}/_apis/notification/diagnosticlogs/{source}/entries/{entryId}';
    protected const PATH_PARAMS = ['source' => 'source', 'organization' => 'organization', 'entryId' => 'entry_id'];
    protected const QUERY_PARAMS = ['startTime' => 'start_time', 'endTime' => 'end_time', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

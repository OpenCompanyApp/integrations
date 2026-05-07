<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queries audit log entries.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://auditservice.dev.azure.com/{organization}/_apis/audit/auditlog.
 */
class AzureDevOpsAuditAuditLogQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_audit_log_query';
    protected const DESCRIPTION = 'Queries audit log entries

Official Azure DevOps REST API 7.2 endpoint: GET https://auditservice.dev.azure.com/{organization}/_apis/audit/auditlog (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'start_time' => ['type' => 'string', 'required' => false, 'description' => 'Start time of download window. Optional'], 'end_time' => ['type' => 'string', 'required' => false, 'description' => 'End time of download window. Optional'], 'batch_size' => ['type' => 'number', 'required' => false, 'description' => 'Max number of results to return. Optional'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Token used for returning next set of results from previous query. Optional'], 'skip_aggregation' => ['type' => 'boolean', 'required' => false, 'description' => 'Skips aggregating events and leaves them as individual entries instead. By default events are aggregated. Event types that are aggregated: AuditLog.AccessLog.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/auditlog';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['startTime' => 'start_time', 'endTime' => 'end_time', 'batchSize' => 'batch_size', 'continuationToken' => 'continuation_token', 'skipAggregation' => 'skip_aggregation', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

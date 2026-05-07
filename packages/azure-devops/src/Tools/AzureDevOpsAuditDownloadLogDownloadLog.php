<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Downloads audit log entries..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://auditservice.dev.azure.com/{organization}/_apis/audit/downloadlog.
 */
class AzureDevOpsAuditDownloadLogDownloadLog extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_download_log_download_log';
    protected const DESCRIPTION = 'Downloads audit log entries.

Official Azure DevOps REST API 7.2 endpoint: GET https://auditservice.dev.azure.com/{organization}/_apis/audit/downloadlog (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'format' => ['type' => 'string', 'required' => false, 'description' => 'File format for download. Can be "json" or "csv".'], 'start_time' => ['type' => 'string', 'required' => false, 'description' => 'Start time of download window. Optional'], 'end_time' => ['type' => 'string', 'required' => false, 'description' => 'End time of download window. Optional'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/downloadlog';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['format' => 'format', 'startTime' => 'start_time', 'endTime' => 'end_time', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

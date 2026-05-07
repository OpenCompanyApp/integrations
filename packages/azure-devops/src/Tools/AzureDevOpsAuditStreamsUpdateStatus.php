<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update existing Audit Stream status.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://auditservice.dev.azure.com/{organization}/_apis/audit/streams/{streamId}.
 */
class AzureDevOpsAuditStreamsUpdateStatus extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_streams_update_status';
    protected const DESCRIPTION = 'Update existing Audit Stream status

Official Azure DevOps REST API 7.2 endpoint: PUT https://auditservice.dev.azure.com/{organization}/_apis/audit/streams/{streamId} (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'stream_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of stream entry to be updated'], 'status' => ['type' => 'string', 'required' => false, 'description' => 'Status of the stream'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/streams/{streamId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'streamId' => 'stream_id'];
    protected const QUERY_PARAMS = ['status' => 'status', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

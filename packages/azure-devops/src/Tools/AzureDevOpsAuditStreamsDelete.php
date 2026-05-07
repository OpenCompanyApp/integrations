<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete Audit Stream.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://auditservice.dev.azure.com/{organization}/_apis/audit/streams/{streamId}.
 */
class AzureDevOpsAuditStreamsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_streams_delete';
    protected const DESCRIPTION = 'Delete Audit Stream

Official Azure DevOps REST API 7.2 endpoint: DELETE https://auditservice.dev.azure.com/{organization}/_apis/audit/streams/{streamId} (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'stream_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of stream entry to delete'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/streams/{streamId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'streamId' => 'stream_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

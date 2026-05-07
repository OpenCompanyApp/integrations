<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Return Audit Stream with id of streamId if one exists otherwise throw.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://auditservice.dev.azure.com/{organization}/_apis/audit/streams/{streamId}.
 */
class AzureDevOpsAuditStreamsQueryStreamById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_streams_query_stream_by_id';
    protected const DESCRIPTION = 'Return Audit Stream with id of streamId if one exists otherwise throw

Official Azure DevOps REST API 7.2 endpoint: GET https://auditservice.dev.azure.com/{organization}/_apis/audit/streams/{streamId} (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'stream_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of stream entry to retrieve'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/streams/{streamId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'streamId' => 'stream_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

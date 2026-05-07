<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update existing Audit Stream.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://auditservice.dev.azure.com/{organization}/_apis/audit/streams.
 */
class AzureDevOpsAuditStreamsUpdateStream extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_streams_update_stream';
    protected const DESCRIPTION = 'Update existing Audit Stream

Official Azure DevOps REST API 7.2 endpoint: PUT https://auditservice.dev.azure.com/{organization}/_apis/audit/streams (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Stream entry'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/streams';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

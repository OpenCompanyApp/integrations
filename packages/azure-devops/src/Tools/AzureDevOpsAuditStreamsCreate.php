<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create new Audit Stream.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://auditservice.dev.azure.com/{organization}/_apis/audit/streams.
 */
class AzureDevOpsAuditStreamsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_streams_create';
    protected const DESCRIPTION = 'Create new Audit Stream

Official Azure DevOps REST API 7.2 endpoint: POST https://auditservice.dev.azure.com/{organization}/_apis/audit/streams (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Stream entry'], 'days_to_backfill' => ['type' => 'number', 'required' => false, 'description' => 'The number of days of previously recorded audit data that will be replayed into the stream. A value of zero will result in only new events being streamed.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/streams';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['daysToBackfill' => 'days_to_backfill', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

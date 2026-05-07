<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all auditable actions filterable by area..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://auditservice.dev.azure.com/{organization}/_apis/audit/actions.
 */
class AzureDevOpsAuditActionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_audit_actions_list';
    protected const DESCRIPTION = 'Get all auditable actions filterable by area.

Official Azure DevOps REST API 7.2 endpoint: GET https://auditservice.dev.azure.com/{organization}/_apis/audit/actions (spec: audit/7.2/audit.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'area_name' => ['type' => 'string', 'required' => false, 'description' => 'Optional. Get actions scoped to area'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'auditservice.dev.azure.com';
    protected const PATH = '/{organization}/_apis/audit/actions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['areaName' => 'area_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific permissions report.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/permissionsreport/{id}.
 */
class AzureDevOpsPermissionsReportPermissionsReportGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_permissions_report_permissions_report_get';
    protected const DESCRIPTION = 'Get a specific permissions report

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/permissionsreport/{id} (spec: permissionsReport/7.2/permissionsReport.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'The ID (GUID) of the permissions report'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/permissionsreport/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

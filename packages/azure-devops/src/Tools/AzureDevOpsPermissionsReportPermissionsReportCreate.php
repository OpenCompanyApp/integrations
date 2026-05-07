<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Request a permissions report to be created asyncronously.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/permissionsreport.
 */
class AzureDevOpsPermissionsReportPermissionsReportCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_permissions_report_permissions_report_create';
    protected const DESCRIPTION = 'Request a permissions report to be created asyncronously

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/permissionsreport (spec: permissionsReport/7.2/permissionsReport.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request configuration to be included in the permissions report'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/permissionsreport';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

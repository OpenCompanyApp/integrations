<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a batch of work item links.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workitemlinks.
 */
class AzureDevOpsWitReportingWorkItemLinksGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_reporting_work_item_links_get';
    protected const DESCRIPTION = 'Get a batch of work item links

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workitemlinks (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'link_types' => ['type' => 'string', 'required' => false, 'description' => 'A list of types to filter the results to specific link types. Omit this parameter to get work item links of all link types.'], 'types' => ['type' => 'string', 'required' => false, 'description' => 'A list of types to filter the results to specific work item types. Omit this parameter to get work item links of all work item types.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Specifies the continuationToken to start the batch from. Omit this parameter to get the first batch of links.'], 'start_date_time' => ['type' => 'string', 'required' => false, 'description' => 'Date/time to use as a starting point for link changes. Only link changes that occurred after that date/time will be returned. Cannot be used in conjunction with \'watermark\' parameter.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/reporting/workitemlinks';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['linkTypes' => 'link_types', 'types' => 'types', 'continuationToken' => 'continuation_token', 'startDateTime' => 'start_date_time', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

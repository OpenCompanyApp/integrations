<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/wit/reporting/workItemRevisions/discussions.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workItemRevisions/discussions.
 */
class AzureDevOpsWitWorkItemRevisionsDiscussionsReadReportingDiscussions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_item_revisions_discussions_read_reporting_discussions';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/wit/reporting/workItemRevisions/discussions

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workItemRevisions/discussions (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `continuationToken`.'], 'max_page_size' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$maxPageSize`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/reporting/workItemRevisions/discussions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['continuationToken' => 'continuation_token', '$maxPageSize' => 'max_page_size', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

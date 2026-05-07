<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a batch of work item revisions. This request may be used if your list of fields is large enough that it may run the URL over the length limit..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workitemrevisions.
 */
class AzureDevOpsWitReportingWorkItemRevisionsReadReportingRevisionsPost extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_reporting_work_item_revisions_read_reporting_revisions_post';
    protected const DESCRIPTION = 'Get a batch of work item revisions. This request may be used if your list of fields is large enough that it may run the URL over the length limit.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workitemrevisions (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'An object that contains request settings: field filter, type filter, identity format'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Specifies the watermark to start the batch from. Omit this parameter to get the first batch of revisions.'], 'start_date_time' => ['type' => 'string', 'required' => false, 'description' => 'Date/time to use as a starting point for revisions, all revisions will occur after this date/time. Cannot be used in conjunction with \'watermark\' parameter.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$expand`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/reporting/workitemrevisions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['continuationToken' => 'continuation_token', 'startDateTime' => 'start_date_time', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

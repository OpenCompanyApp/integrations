<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a batch of work item revisions with the option of including deleted items.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workitemrevisions.
 */
class AzureDevOpsWitReportingWorkItemRevisionsReadReportingRevisionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_reporting_work_item_revisions_read_reporting_revisions_get';
    protected const DESCRIPTION = 'Get a batch of work item revisions with the option of including deleted items

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/reporting/workitemrevisions (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'fields' => ['type' => 'string', 'required' => false, 'description' => 'A list of fields to return in work item revisions. Omit this parameter to get all reportable fields.'], 'types' => ['type' => 'string', 'required' => false, 'description' => 'A list of types to filter the results to specific work item types. Omit this parameter to get work item revisions of all work item types.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Specifies the watermark to start the batch from. Omit this parameter to get the first batch of revisions.'], 'start_date_time' => ['type' => 'string', 'required' => false, 'description' => 'Date/time to use as a starting point for revisions, all revisions will occur after this date/time. Cannot be used in conjunction with \'watermark\' parameter.'], 'include_identity_ref' => ['type' => 'boolean', 'required' => false, 'description' => 'Return an identity reference instead of a string value for identity fields.'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Specify if the deleted item should be returned.'], 'include_tag_ref' => ['type' => 'boolean', 'required' => false, 'description' => 'Specify if the tag objects should be returned for System.Tags field.'], 'include_latest_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Return only the latest revisions of work items, skipping all historical revisions'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Return all the fields in work item revisions, including long text fields which are not returned by default'], 'include_discussion_changes_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Return only the those revisions of work items, where only history field was changed'], 'max_page_size' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of results to return in this batch'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/reporting/workitemrevisions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['fields' => 'fields', 'types' => 'types', 'continuationToken' => 'continuation_token', 'startDateTime' => 'start_date_time', 'includeIdentityRef' => 'include_identity_ref', 'includeDeleted' => 'include_deleted', 'includeTagRef' => 'include_tag_ref', 'includeLatestOnly' => 'include_latest_only', '$expand' => 'expand', 'includeDiscussionChangesOnly' => 'include_discussion_changes_only', '$maxPageSize' => 'max_page_size', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

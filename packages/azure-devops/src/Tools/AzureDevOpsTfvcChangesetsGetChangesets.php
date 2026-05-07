<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve Tfvc Changesets Note: This is a new version of the GetChangesets API that doesn't expose the unneeded queryParams present in the 1.0 version of the API..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/changesets.
 */
class AzureDevOpsTfvcChangesetsGetChangesets extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_changesets_get_changesets';
    protected const DESCRIPTION = 'Retrieve Tfvc Changesets Note: This is a new version of the GetChangesets API that doesn\'t expose the unneeded queryParams present in the 1.0 version of the API.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/changesets (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'max_comment_length' => ['type' => 'number', 'required' => false, 'description' => 'Include details about associated work items in the response. Default: null'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of results to skip. Default: null'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of results to return. Default: null'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Results are sorted by ID in descending order by default. Use id asc to sort by ID in ascending order.'], 'search_criteria_author' => ['type' => 'string', 'required' => false, 'description' => 'Alias or display name of user who made the changes.'], 'search_criteria_follow_renames' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether or not to follow renames for the given item being queried.'], 'search_criteria_from_date' => ['type' => 'string', 'required' => false, 'description' => 'If provided, only include changesets created after this date (string).'], 'search_criteria_from_id' => ['type' => 'number', 'required' => false, 'description' => 'If provided, only include changesets after this changesetID.'], 'search_criteria_include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the _links field on the shallow references.'], 'search_criteria_item_path' => ['type' => 'string', 'required' => false, 'description' => 'Path of item to search under.'], 'search_criteria_mappings' => ['type' => 'array', 'required' => false, 'description' => 'Following criteria available (.itemPath, .version, .versionType, .versionOption, .author, .fromId, .toId, .fromDate, .toDate) Default: null'], 'search_criteria_to_date' => ['type' => 'string', 'required' => false, 'description' => 'If provided, only include changesets created before this date (string).'], 'search_criteria_to_id' => ['type' => 'number', 'required' => false, 'description' => 'If provided, a version descriptor for the latest change list to include.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/tfvc/changesets';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['maxCommentLength' => 'max_comment_length', '$skip' => 'skip', '$top' => 'top', '$orderby' => 'orderby', 'searchCriteria.author' => 'search_criteria_author', 'searchCriteria.followRenames' => 'search_criteria_follow_renames', 'searchCriteria.fromDate' => 'search_criteria_from_date', 'searchCriteria.fromId' => 'search_criteria_from_id', 'searchCriteria.includeLinks' => 'search_criteria_include_links', 'searchCriteria.itemPath' => 'search_criteria_item_path', 'searchCriteria.mappings' => 'search_criteria_mappings', 'searchCriteria.toDate' => 'search_criteria_to_date', 'searchCriteria.toId' => 'search_criteria_to_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieves pushes associated with the specified repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pushes.
 */
class AzureDevOpsGitPushesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pushes_list';
    protected const DESCRIPTION = 'Retrieves pushes associated with the specified repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pushes (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of pushes to skip.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of pushes to return.'], 'search_criteria_from_date' => ['type' => 'string', 'required' => false, 'description' => 'Search criteria attributes: fromDate, toDate, pusherId, refName, includeRefUpdates or includeLinks. fromDate: Start date to search from. toDate: End date to search to. pusherId: Identity of the person who submitted the push. refName: Branch name to consider. includeRefUpdates: If true, include the list of refs that were updated by the push. includeLinks: Whether to include the _links field on the shallow references.'], 'search_criteria_include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the _links field on the shallow references'], 'search_criteria_include_ref_updates' => ['type' => 'boolean', 'required' => false, 'description' => 'Search criteria attributes: fromDate, toDate, pusherId, refName, includeRefUpdates or includeLinks. fromDate: Start date to search from. toDate: End date to search to. pusherId: Identity of the person who submitted the push. refName: Branch name to consider. includeRefUpdates: If true, include the list of refs that were updated by the push. includeLinks: Whether to include the _links field on the shallow references.'], 'search_criteria_pusher_id' => ['type' => 'string', 'required' => false, 'description' => 'Search criteria attributes: fromDate, toDate, pusherId, refName, includeRefUpdates or includeLinks. fromDate: Start date to search from. toDate: End date to search to. pusherId: Identity of the person who submitted the push. refName: Branch name to consider. includeRefUpdates: If true, include the list of refs that were updated by the push. includeLinks: Whether to include the _links field on the shallow references.'], 'search_criteria_ref_name' => ['type' => 'string', 'required' => false, 'description' => 'Search criteria attributes: fromDate, toDate, pusherId, refName, includeRefUpdates or includeLinks. fromDate: Start date to search from. toDate: End date to search to. pusherId: Identity of the person who submitted the push. refName: Branch name to consider. includeRefUpdates: If true, include the list of refs that were updated by the push. includeLinks: Whether to include the _links field on the shallow references.'], 'search_criteria_to_date' => ['type' => 'string', 'required' => false, 'description' => 'Search criteria attributes: fromDate, toDate, pusherId, refName, includeRefUpdates or includeLinks. fromDate: Start date to search from. toDate: End date to search to. pusherId: Identity of the person who submitted the push. refName: Branch name to consider. includeRefUpdates: If true, include the list of refs that were updated by the push. includeLinks: Whether to include the _links field on the shallow references.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pushes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$skip' => 'skip', '$top' => 'top', 'searchCriteria.fromDate' => 'search_criteria_from_date', 'searchCriteria.includeLinks' => 'search_criteria_include_links', 'searchCriteria.includeRefUpdates' => 'search_criteria_include_ref_updates', 'searchCriteria.pusherId' => 'search_criteria_pusher_id', 'searchCriteria.refName' => 'search_criteria_ref_name', 'searchCriteria.toDate' => 'search_criteria_to_date', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

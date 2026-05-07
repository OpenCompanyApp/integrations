<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Provides a set of results for the search request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://almsearch.dev.azure.com/{organization}/{project}/_apis/search/wikisearchresults.
 */
class AzureDevOpsSearchWikiSearchResultsFetchWikiSearchResults extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_search_wiki_search_results_fetch_wiki_search_results';
    protected const DESCRIPTION = 'Provides a set of results for the search request.

Official Azure DevOps REST API 7.2 endpoint: POST https://almsearch.dev.azure.com/{organization}/{project}/_apis/search/wikisearchresults (spec: search/7.2/search.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The Wiki Search Request.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'almsearch.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/search/wikisearchresults';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

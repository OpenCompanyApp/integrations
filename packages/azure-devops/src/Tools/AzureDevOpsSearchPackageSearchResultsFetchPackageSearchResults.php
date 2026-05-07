<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Provides a set of results for the search text..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://almsearch.dev.azure.com/{organization}/_apis/search/packagesearchresults.
 */
class AzureDevOpsSearchPackageSearchResultsFetchPackageSearchResults extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_search_package_search_results_fetch_package_search_results';
    protected const DESCRIPTION = 'Provides a set of results for the search text.

Official Azure DevOps REST API 7.2 endpoint: POST https://almsearch.dev.azure.com/{organization}/_apis/search/packagesearchresults (spec: search/7.2/search.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The Package Search Request.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'almsearch.dev.azure.com';
    protected const PATH = '/{organization}/_apis/search/packagesearchresults';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

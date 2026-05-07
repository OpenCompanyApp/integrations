<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a list of source code repositories..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/repositories.
 */
class AzureDevOpsBuildSourceProvidersListRepositories extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_source_providers_list_repositories';
    protected const DESCRIPTION = 'Gets a list of source code repositories.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/repositories (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'provider_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the source provider.'], 'service_endpoint_id' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the ID of the service endpoint to query. Can only be omitted for providers that do not use service endpoints, e.g. TFVC or TFGit.'], 'repository' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the vendor-specific identifier or the name of a single repository to get.'], 'result_set' => ['type' => 'string', 'required' => false, 'description' => '\'top\' for the repositories most relevant for the endpoint. If not set, all repositories are returned. Ignored if \'repository\' is set.'], 'page_results' => ['type' => 'boolean', 'required' => false, 'description' => 'If set to true, this will limit the set of results and will return a continuation token to continue the query.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'When paging results, this is a continuation token, returned by a previous call to this method, that can be used to return the next set of repositories.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/sourceProviders/{providerName}/repositories';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'providerName' => 'provider_name'];
    protected const QUERY_PARAMS = ['serviceEndpointId' => 'service_endpoint_id', 'repository' => 'repository', 'resultSet' => 'result_set', 'pageResults' => 'page_results', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

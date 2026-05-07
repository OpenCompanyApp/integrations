<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the contents of a directory in the given source code repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/pathcontents.
 */
class AzureDevOpsBuildSourceProvidersGetPathContents extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_source_providers_get_path_contents';
    protected const DESCRIPTION = 'Gets the contents of a directory in the given source code repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/pathcontents (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'provider_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the source provider.'], 'service_endpoint_id' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the ID of the service endpoint to query. Can only be omitted for providers that do not use service endpoints, e.g. TFVC or TFGit.'], 'repository' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the vendor-specific identifier or the name of the repository to get branches. Can only be omitted for providers that do not support multiple repositories.'], 'commit_or_branch' => ['type' => 'string', 'required' => false, 'description' => 'The identifier of the commit or branch from which a file\'s contents are retrieved.'], 'path' => ['type' => 'string', 'required' => false, 'description' => 'The path contents to list, relative to the root of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/sourceProviders/{providerName}/pathcontents';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'providerName' => 'provider_name'];
    protected const QUERY_PARAMS = ['serviceEndpointId' => 'service_endpoint_id', 'repository' => 'repository', 'commitOrBranch' => 'commit_or_branch', 'path' => 'path', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a pull request object from source provider..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/pullrequests/{pullRequestId}.
 */
class AzureDevOpsBuildSourceProvidersGetPullRequest extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_source_providers_get_pull_request';
    protected const DESCRIPTION = 'Gets a pull request object from source provider.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/pullrequests/{pullRequestId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'provider_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the source provider.'], 'pull_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Vendor-specific id of the pull request.'], 'repository_id' => ['type' => 'string', 'required' => false, 'description' => 'Vendor-specific identifier or the name of the repository that contains the pull request.'], 'service_endpoint_id' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the ID of the service endpoint to query. Can only be omitted for providers that do not use service endpoints, e.g. TFVC or TFGit.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/sourceProviders/{providerName}/pullrequests/{pullRequestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'providerName' => 'provider_name', 'pullRequestId' => 'pull_request_id'];
    protected const QUERY_PARAMS = ['repositoryId' => 'repository_id', 'serviceEndpointId' => 'service_endpoint_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

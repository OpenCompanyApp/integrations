<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Recreates the webhooks for the specified triggers in the given source code repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/webhooks.
 */
class AzureDevOpsBuildSourceProvidersRestoreWebhooks extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_source_providers_restore_webhooks';
    protected const DESCRIPTION = 'Recreates the webhooks for the specified triggers in the given source code repository.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/sourceProviders/{providerName}/webhooks (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The types of triggers to restore webhooks for.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'provider_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the source provider.'], 'service_endpoint_id' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the ID of the service endpoint to query. Can only be omitted for providers that do not use service endpoints, e.g. TFVC or TFGit.'], 'repository' => ['type' => 'string', 'required' => false, 'description' => 'If specified, the vendor-specific identifier or the name of the repository to get webhooks. Can only be omitted for providers that do not support multiple repositories.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/sourceProviders/{providerName}/webhooks';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'providerName' => 'provider_name'];
    protected const QUERY_PARAMS = ['serviceEndpointId' => 'service_endpoint_id', 'repository' => 'repository', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

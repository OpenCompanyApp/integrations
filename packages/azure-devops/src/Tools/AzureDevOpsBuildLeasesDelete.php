<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes specific retention leases..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/build/retention/leases.
 */
class AzureDevOpsBuildLeasesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_leases_delete';
    protected const DESCRIPTION = 'Removes specific retention leases.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/build/retention/leases (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'ids' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `ids`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/retention/leases';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['ids' => 'ids', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

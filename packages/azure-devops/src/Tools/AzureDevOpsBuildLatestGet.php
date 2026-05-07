<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the latest build for a definition, optionally scoped to a specific branch..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/latest/{definition}.
 */
class AzureDevOpsBuildLatestGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_latest_get';
    protected const DESCRIPTION = 'Gets the latest build for a definition, optionally scoped to a specific branch.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/latest/{definition} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition' => ['type' => 'string', 'required' => true, 'description' => 'definition name with optional leading folder path, or the definition id'], 'branch_name' => ['type' => 'string', 'required' => false, 'description' => 'optional parameter that indicates the specific branch to use. If not specified, the default branch is used.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/latest/{definition}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definition' => 'definition'];
    protected const QUERY_PARAMS = ['branchName' => 'branch_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

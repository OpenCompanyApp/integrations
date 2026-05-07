<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a list of build definition folders..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/folders/{path}.
 */
class AzureDevOpsBuildFoldersList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_folders_list';
    protected const DESCRIPTION = 'Gets a list of build definition folders.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/folders/{path} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'The path to start with.'], 'query_order' => ['type' => 'string', 'required' => false, 'description' => 'The order in which folders should be returned.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/folders/{path}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'path' => 'path'];
    protected const QUERY_PARAMS = ['queryOrder' => 'query_order', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

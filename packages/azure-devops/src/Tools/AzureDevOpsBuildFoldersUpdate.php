<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates an existing folder at given existing path.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/build/folders.
 */
class AzureDevOpsBuildFoldersUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_folders_update';
    protected const DESCRIPTION = 'Updates an existing folder at given existing path

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/build/folders (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The new version of the folder.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'path' => ['type' => 'string', 'required' => false, 'description' => 'The full path to the folder.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/folders';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['path' => 'path', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

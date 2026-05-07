<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes a definition folder. Definitions and their corresponding builds will also be deleted..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/build/folders.
 */
class AzureDevOpsBuildFoldersDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_folders_delete';
    protected const DESCRIPTION = 'Deletes a definition folder. Definitions and their corresponding builds will also be deleted.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/build/folders (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'path' => ['type' => 'string', 'required' => false, 'description' => 'The full path to the folder.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/folders';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['path' => 'path', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

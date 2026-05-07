<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes a definition folder for given folder name and path and all it's existing definitions..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/folders/{path}.
 */
class AzureDevOpsReleaseFoldersDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_folders_delete';
    protected const DESCRIPTION = 'Deletes a definition folder for given folder name and path and all it\'s existing definitions.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/folders/{path} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'Path of the folder to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/folders/{path}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'path' => 'path'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

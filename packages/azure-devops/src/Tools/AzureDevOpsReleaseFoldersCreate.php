<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * This method is no longer supported. Use CreateFolder with folder parameter API..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/folders/{path}.
 */
class AzureDevOpsReleaseFoldersCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_folders_create';
    protected const DESCRIPTION = 'This method is no longer supported. Use CreateFolder with folder parameter API.

Official Azure DevOps REST API 7.2 endpoint: POST https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/folders/{path} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'folder.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'Path of the folder.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/folders/{path}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'path' => 'path'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

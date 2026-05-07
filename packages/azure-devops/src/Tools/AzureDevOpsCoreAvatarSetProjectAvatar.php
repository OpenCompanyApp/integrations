<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Sets the avatar for the project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/_apis/projects/{projectId}/avatar.
 */
class AzureDevOpsCoreAvatarSetProjectAvatar extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_avatar_set_project_avatar';
    protected const DESCRIPTION = 'Sets the avatar for the project.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/_apis/projects/{projectId}/avatar (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The avatar blob data object to upload.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the project.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/avatar';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

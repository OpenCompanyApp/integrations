<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update an existing project's name, abbreviation, description, or restore a project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/projects/{projectId}.
 */
class AzureDevOpsCoreProjectsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_update';
    protected const DESCRIPTION = 'Update an existing project\'s name, abbreviation, description, or restore a project.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/projects/{projectId} (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The updates for the project. The state must be set to wellFormed to restore the project.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project id of the project to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

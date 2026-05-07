<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a release definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions.
 */
class AzureDevOpsReleaseDefinitionsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_definitions_update';
    protected const DESCRIPTION = 'Update a release definition.

Official Azure DevOps REST API 7.2 endpoint: PUT https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Release definition object to update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'skip_tasks_validation' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip task validation boolean flag'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/definitions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['skipTasksValidation' => 'skip_tasks_validation', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

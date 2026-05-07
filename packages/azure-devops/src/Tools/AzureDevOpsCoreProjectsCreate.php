<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queues a project to be created. Use the [GetOperation](../../operations/operations/get) to periodically check for create project status..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/projects.
 */
class AzureDevOpsCoreProjectsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_create';
    protected const DESCRIPTION = 'Queues a project to be created. Use the [GetOperation](../../operations/operations/get) to periodically check for create project status.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/projects (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The project to create.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a collection of team project properties..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/properties.
 */
class AzureDevOpsCoreProjectsGetProjectProperties extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_get_project_properties';
    protected const DESCRIPTION = 'Get a collection of team project properties.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/properties (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The team project ID.'], 'keys' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited string of team project property names. Wildcard characters ("?" and "*") are supported. If no key is specified, all properties will be returned.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/properties';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['keys' => 'keys', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

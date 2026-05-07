<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create, update, and delete team project properties..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/projects/{projectId}/properties.
 */
class AzureDevOpsCoreProjectsSetProjectProperties extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_set_project_properties';
    protected const DESCRIPTION = 'Create, update, and delete team project properties.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/projects/{projectId}/properties (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The team project ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A JSON Patch document that represents an array of property operations. See RFC 6902 for more details on JSON Patch. The accepted operation verbs are Add and Remove, where Add is used for both creating and updating properties. The path consists of a forward slash and a property name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/properties';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

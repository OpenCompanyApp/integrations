<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates properties for a definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}/properties.
 */
class AzureDevOpsBuildPropertiesUpdateDefinitionProperties extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_properties_update_definition_properties';
    protected const DESCRIPTION = 'Updates properties for a definition.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{definitionId}/properties (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A json-patch document describing the properties to update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the definition.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions/{definitionId}/properties';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

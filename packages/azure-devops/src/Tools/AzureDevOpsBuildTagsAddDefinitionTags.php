<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Adds multiple tags to a definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{DefinitionId}/tags.
 */
class AzureDevOpsBuildTagsAddDefinitionTags extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_tags_add_definition_tags';
    protected const DESCRIPTION = 'Adds multiple tags to a definition.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/build/definitions/{DefinitionId}/tags (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The tags to add.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the definition.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions/{DefinitionId}/tags';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

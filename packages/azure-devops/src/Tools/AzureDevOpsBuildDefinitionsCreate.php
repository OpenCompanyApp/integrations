<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a new definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/build/definitions.
 */
class AzureDevOpsBuildDefinitionsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_definitions_create';
    protected const DESCRIPTION = 'Creates a new definition.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/build/definitions (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The definition.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_to_clone_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `definitionToCloneId`.'], 'definition_to_clone_revision' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `definitionToCloneRevision`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.8`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/definitions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['definitionToCloneId' => 'definition_to_clone_id', 'definitionToCloneRevision' => 'definition_to_clone_revision', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.8';
}

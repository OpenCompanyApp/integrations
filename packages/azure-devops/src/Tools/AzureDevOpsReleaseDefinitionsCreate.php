<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a release definition.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions.
 */
class AzureDevOpsReleaseDefinitionsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_definitions_create';
    protected const DESCRIPTION = 'Create a release definition

Official Azure DevOps REST API 7.2 endpoint: POST https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'release definition object to create.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/definitions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

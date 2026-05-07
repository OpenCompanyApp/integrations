<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get release definition for a given definitionId and revision.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/Release/definitions/{definitionId}/revisions/{revision}.
 */
class AzureDevOpsReleaseDefinitionsGetDefinitionRevision extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_definitions_get_definition_revision';
    protected const DESCRIPTION = 'Get release definition for a given definitionId and revision

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/Release/definitions/{definitionId}/revisions/{revision} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the definition.'], 'revision' => ['type' => 'number', 'required' => true, 'description' => 'Id of the revision.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/Release/definitions/{definitionId}/revisions/{revision}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id', 'revision' => 'revision'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

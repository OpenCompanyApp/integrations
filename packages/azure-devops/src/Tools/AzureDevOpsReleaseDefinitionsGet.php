<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a release definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions/{definitionId}.
 */
class AzureDevOpsReleaseDefinitionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_definitions_get';
    protected const DESCRIPTION = 'Get a release definition.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions/{definitionId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release definition.'], 'property_filters' => ['type' => 'string', 'required' => false, 'description' => 'A comma-delimited list of extended properties to be retrieved. If set, the returned Release Definition will contain values for the specified property Ids (if they exist). If not set, properties will not be included.'], 'include_disabled' => ['type' => 'boolean', 'required' => false, 'description' => 'Boolean flag to include disabled definitions.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/definitions/{definitionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['propertyFilters' => 'property_filters', 'includeDisabled' => 'include_disabled', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

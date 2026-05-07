<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a release definition..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions/{definitionId}.
 */
class AzureDevOpsReleaseDefinitionsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_definitions_delete';
    protected const DESCRIPTION = 'Delete a release definition.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/definitions/{definitionId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release definition.'], 'comment' => ['type' => 'string', 'required' => false, 'description' => 'Comment for deleting a release definition.'], 'force_delete' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\' to automatically cancel any in-progress release deployments and proceed with release definition deletion . Default is \'false\'.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/definitions/{definitionId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['comment' => 'comment', 'forceDelete' => 'force_delete', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

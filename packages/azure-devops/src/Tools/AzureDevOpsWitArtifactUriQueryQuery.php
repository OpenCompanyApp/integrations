<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queries work items linked to a given list of artifact URI..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wit/artifacturiquery.
 */
class AzureDevOpsWitArtifactUriQueryQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_artifact_uri_query_query';
    protected const DESCRIPTION = 'Queries work items linked to a given list of artifact URI.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wit/artifacturiquery (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Defines a list of artifact URI for querying work items.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/artifacturiquery';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

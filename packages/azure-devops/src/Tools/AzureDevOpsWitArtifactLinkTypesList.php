<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the list of work item tracking outbound artifact link types..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/wit/artifactlinktypes.
 */
class AzureDevOpsWitArtifactLinkTypesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_artifact_link_types_list';
    protected const DESCRIPTION = 'Get the list of work item tracking outbound artifact link types.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/wit/artifactlinktypes (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/wit/artifactlinktypes';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

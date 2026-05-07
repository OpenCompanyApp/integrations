<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the results of the query given the query ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/wit/wiql/{id}.
 */
class AzureDevOpsWitWiqlQueryById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_wiql_query_by_id';
    protected const DESCRIPTION = 'Gets the results of the query given the query ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/wit/wiql/{id} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'The query ID.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'time_precision' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether or not to use time precision.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The max number of results to return.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/wit/wiql/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id', 'project' => 'project', 'team' => 'team'];
    protected const QUERY_PARAMS = ['timePrecision' => 'time_precision', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns any leases matching the specified MinimalRetentionLeases.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/retention/leases.
 */
class AzureDevOpsBuildLeasesGetRetentionLeasesByMinimalRetentionLeases extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_leases_get_retention_leases_by_minimal_retention_leases';
    protected const DESCRIPTION = 'Returns any leases matching the specified MinimalRetentionLeases

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/retention/leases (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'leases_to_fetch' => ['type' => 'string', 'required' => false, 'description' => 'List of JSON-serialized MinimalRetentionLeases separated by \'|\''], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/retention/leases';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['leasesToFetch' => 'leases_to_fetch', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

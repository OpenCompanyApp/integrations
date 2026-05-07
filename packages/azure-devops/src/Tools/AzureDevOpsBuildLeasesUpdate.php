<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates the duration or pipeline protection status of a retention lease..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/build/retention/leases/{leaseId}.
 */
class AzureDevOpsBuildLeasesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_leases_update';
    protected const DESCRIPTION = 'Updates the duration or pipeline protection status of a retention lease.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/build/retention/leases/{leaseId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The new data for the retention lease.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'lease_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the lease to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/retention/leases/{leaseId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'leaseId' => 'lease_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get alerts by alert IDs Currently supports fetching secret alerts only..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/AlertsBatch.
 */
class AzureDevOpsAdvancedSecurityAlertsBatchList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_alerts_batch_list';
    protected const DESCRIPTION = 'Get alerts by alert IDs Currently supports fetching secret alerts only.

Official Azure DevOps REST API 7.2 endpoint: POST https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/AlertsBatch (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request containing alert IDs and optional alert type filter'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/AlertsBatch';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

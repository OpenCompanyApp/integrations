<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get an alert metadata..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}/metadata.
 */
class AzureDevOpsAdvancedSecurityMetadata2Get extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_metadata2_get';
    protected const DESCRIPTION = 'Get an alert metadata.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}/metadata (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'alert_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of alert to retrieve'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'Name or id of a repository that alert is part of'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}/metadata';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'alertId' => 'alert_id', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

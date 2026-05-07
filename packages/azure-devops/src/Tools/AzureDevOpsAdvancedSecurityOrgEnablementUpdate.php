<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the status of Advanced Security for the organization.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://advsec.dev.azure.com/{organization}/_apis/management/enablement.
 */
class AzureDevOpsAdvancedSecurityOrgEnablementUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_org_enablement_update';
    protected const DESCRIPTION = 'Update the status of Advanced Security for the organization

Official Azure DevOps REST API 7.2 endpoint: PATCH https://advsec.dev.azure.com/{organization}/_apis/management/enablement (spec: advancedSecurity/7.2/management.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The new status'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/management/enablement';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

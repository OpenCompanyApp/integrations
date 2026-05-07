<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get alerts metadata..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/metadatabatch.
 */
class AzureDevOpsAdvancedSecurityMetadataBatchList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_metadata_batch_list';
    protected const DESCRIPTION = 'Get alerts metadata.

Official Azure DevOps REST API 7.2 endpoint: POST https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/metadatabatch (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'Name or id of a repository that alert is part of'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/metadatabatch';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

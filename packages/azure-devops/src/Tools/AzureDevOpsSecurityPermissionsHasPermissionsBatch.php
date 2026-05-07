<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Evaluates multiple permissions for the calling user. Note: This method does not aggregate the results, nor does it short-circuit if one of the permissions evaluates to false..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/security/permissionevaluationbatch.
 */
class AzureDevOpsSecurityPermissionsHasPermissionsBatch extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_security_permissions_has_permissions_batch';
    protected const DESCRIPTION = 'Evaluates multiple permissions for the calling user. Note: This method does not aggregate the results, nor does it short-circuit if one of the permissions evaluates to false.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/security/permissionevaluationbatch (spec: security/7.2/security.json).';
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'The set of evaluation requests.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/security/permissionevaluationbatch';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

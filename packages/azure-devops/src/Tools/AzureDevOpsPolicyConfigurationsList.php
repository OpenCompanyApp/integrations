<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of policy configurations in a project. The 'scope' parameter for this API should not be used, except for legacy compatability reasons. It returns specifically scoped policies and does not support heirarchical nesting. Instead, use the /_apis/git/policy/configurations API, which provides first class scope filtering support. The optional `policyType` parameter can be used to filter the set of policies returned from this method..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/policy/configurations.
 */
class AzureDevOpsPolicyConfigurationsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_configurations_list';
    protected const DESCRIPTION = 'Get a list of policy configurations in a project. The \'scope\' parameter for this API should not be used, except for legacy compatability reasons. It returns specifically scoped policies and does not support heirarchical nesting. Instead, use the /_apis/git/policy/configurations API, which provides first class scope filtering support. The optional `policyType` parameter can be used to filter the set of policies returned from this method.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/policy/configurations (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'scope' => ['type' => 'string', 'required' => false, 'description' => '[Provided for legacy reasons] The scope on which a subset of policies is defined.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of policies to return.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'The continuation token used for pagination.'], 'policy_type' => ['type' => 'string', 'required' => false, 'description' => 'Filter returned policies to only this type'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/configurations';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['scope' => 'scope', '$top' => 'top', 'continuationToken' => 'continuation_token', 'policyType' => 'policy_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

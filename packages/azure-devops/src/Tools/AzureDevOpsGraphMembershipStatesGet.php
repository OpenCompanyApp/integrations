<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Check whether a subject is active or inactive..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/membershipstates/{subjectDescriptor}.
 */
class AzureDevOpsGraphMembershipStatesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_membership_states_get';
    protected const DESCRIPTION = 'Check whether a subject is active or inactive.

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/membershipstates/{subjectDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subject_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'Descriptor of the subject (user, group, scope, etc.) to check state of'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/membershipstates/{subjectDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subjectDescriptor' => 'subject_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

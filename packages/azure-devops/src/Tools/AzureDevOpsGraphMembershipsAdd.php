<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a new membership between a container and subject..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://vssps.dev.azure.com/{organization}/_apis/graph/memberships/{subjectDescriptor}/{containerDescriptor}.
 */
class AzureDevOpsGraphMembershipsAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_memberships_add';
    protected const DESCRIPTION = 'Create a new membership between a container and subject.

Official Azure DevOps REST API 7.2 endpoint: PUT https://vssps.dev.azure.com/{organization}/_apis/graph/memberships/{subjectDescriptor}/{containerDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subject_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'A descriptor to a group or user that can be the child subject in the relationship.'], 'container_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'A descriptor to a group that can be the container in the relationship.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/memberships/{subjectDescriptor}/{containerDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'subjectDescriptor' => 'subject_descriptor', 'containerDescriptor' => 'container_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

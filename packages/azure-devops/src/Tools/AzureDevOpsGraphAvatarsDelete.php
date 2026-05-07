<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * DELETE /{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vssps.dev.azure.com/{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars.
 */
class AzureDevOpsGraphAvatarsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_avatars_delete';
    protected const DESCRIPTION = 'DELETE /{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vssps.dev.azure.com/{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['subject_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subjectDescriptor`.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars';
    protected const PATH_PARAMS = ['subjectDescriptor' => 'subject_descriptor', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

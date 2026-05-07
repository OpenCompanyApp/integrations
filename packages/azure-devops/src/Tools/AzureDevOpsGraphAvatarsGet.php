<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars.
 */
class AzureDevOpsGraphAvatarsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_avatars_get';
    protected const DESCRIPTION = 'GET /{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['subject_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `subjectDescriptor`.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'size' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `size`.'], 'format' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `format`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/Subjects/{subjectDescriptor}/avatars';
    protected const PATH_PARAMS = ['subjectDescriptor' => 'subject_descriptor', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['size' => 'size', 'format' => 'format', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

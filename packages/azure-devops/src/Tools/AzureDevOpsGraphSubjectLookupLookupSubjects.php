<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Resolve descriptors to users, groups or scopes (Subjects) in a batch..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/graph/subjectlookup.
 */
class AzureDevOpsGraphSubjectLookupLookupSubjects extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_subject_lookup_lookup_subjects';
    protected const DESCRIPTION = 'Resolve descriptors to users, groups or scopes (Subjects) in a batch.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/graph/subjectlookup (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A list of descriptors that specifies a subset of subjects to retrieve. Each descriptor uniquely identifies the subject across all instance scopes, but only at a single point in time.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/subjectlookup';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

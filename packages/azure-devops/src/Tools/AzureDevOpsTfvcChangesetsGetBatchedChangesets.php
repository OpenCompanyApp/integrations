<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns changesets for a given list of changeset Ids..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/tfvc/changesetsbatch.
 */
class AzureDevOpsTfvcChangesetsGetBatchedChangesets extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_changesets_get_batched_changesets';
    protected const DESCRIPTION = 'Returns changesets for a given list of changeset Ids.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/tfvc/changesetsbatch (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'List of changeset IDs.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/changesetsbatch';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

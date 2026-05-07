<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve Tfvc changes for a given changeset..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/tfvc/changesets/{id}/changes.
 */
class AzureDevOpsTfvcChangesetsGetChangesetChanges extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_changesets_get_changeset_changes';
    protected const DESCRIPTION = 'Retrieve Tfvc changes for a given changeset.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/tfvc/changesets/{id}/changes (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the changeset. Default: null'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of results to skip. Default: null'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of results to return. Default: null'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Return the next page of results. Default: null'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/changesets/{id}/changes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id'];
    protected const QUERY_PARAMS = ['$skip' => 'skip', '$top' => 'top', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

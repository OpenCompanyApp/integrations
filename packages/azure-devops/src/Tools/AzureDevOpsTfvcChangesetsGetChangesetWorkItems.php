<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieves the work items associated with a particular changeset..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/tfvc/changesets/{id}/workItems.
 */
class AzureDevOpsTfvcChangesetsGetChangesetWorkItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_changesets_get_changeset_work_items';
    protected const DESCRIPTION = 'Retrieves the work items associated with a particular changeset.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/tfvc/changesets/{id}/workItems (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the changeset.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/changesets/{id}/workItems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

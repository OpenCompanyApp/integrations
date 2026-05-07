<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a collection of shallow label references..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/labels.
 */
class AzureDevOpsTfvcLabelsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_labels_list';
    protected const DESCRIPTION = 'Get a collection of shallow label references.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/labels (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'request_data_include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the _links field on the shallow references'], 'request_data_item_label_filter' => ['type' => 'string', 'required' => false, 'description' => 'labelScope, name, owner, and itemLabelFilter'], 'request_data_label_scope' => ['type' => 'string', 'required' => false, 'description' => 'labelScope, name, owner, and itemLabelFilter'], 'request_data_max_item_count' => ['type' => 'number', 'required' => false, 'description' => 'labelScope, name, owner, and itemLabelFilter'], 'request_data_name' => ['type' => 'string', 'required' => false, 'description' => 'labelScope, name, owner, and itemLabelFilter'], 'request_data_owner' => ['type' => 'string', 'required' => false, 'description' => 'labelScope, name, owner, and itemLabelFilter'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Max number of labels to return, defaults to 100 when undefined'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of labels to skip'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/tfvc/labels';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['requestData.includeLinks' => 'request_data_include_links', 'requestData.itemLabelFilter' => 'request_data_item_label_filter', 'requestData.labelScope' => 'request_data_label_scope', 'requestData.maxItemCount' => 'request_data_max_item_count', 'requestData.name' => 'request_data_name', 'requestData.owner' => 'request_data_owner', '$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

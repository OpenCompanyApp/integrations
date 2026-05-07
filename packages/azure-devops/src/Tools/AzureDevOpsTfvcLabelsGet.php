<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a single deep label..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/labels/{labelId}.
 */
class AzureDevOpsTfvcLabelsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_labels_get';
    protected const DESCRIPTION = 'Get a single deep label.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/labels/{labelId} (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'label_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier of label'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'request_data_include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the _links field on the shallow references'], 'request_data_item_label_filter' => ['type' => 'string', 'required' => false, 'description' => 'maxItemCount'], 'request_data_label_scope' => ['type' => 'string', 'required' => false, 'description' => 'maxItemCount'], 'request_data_max_item_count' => ['type' => 'number', 'required' => false, 'description' => 'maxItemCount'], 'request_data_name' => ['type' => 'string', 'required' => false, 'description' => 'maxItemCount'], 'request_data_owner' => ['type' => 'string', 'required' => false, 'description' => 'maxItemCount'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/tfvc/labels/{labelId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'labelId' => 'label_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['requestData.includeLinks' => 'request_data_include_links', 'requestData.itemLabelFilter' => 'request_data_item_label_filter', 'requestData.labelScope' => 'request_data_label_scope', 'requestData.maxItemCount' => 'request_data_max_item_count', 'requestData.name' => 'request_data_name', 'requestData.owner' => 'request_data_owner', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

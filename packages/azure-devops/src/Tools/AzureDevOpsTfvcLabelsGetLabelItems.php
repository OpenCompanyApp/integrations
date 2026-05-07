<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get items under a label..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/tfvc/labels/{labelId}/items.
 */
class AzureDevOpsTfvcLabelsGetLabelItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_labels_get_label_items';
    protected const DESCRIPTION = 'Get items under a label.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/tfvc/labels/{labelId}/items (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'label_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier of label'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Max number of items to return'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of items to skip'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/tfvc/labels/{labelId}/items';
    protected const PATH_PARAMS = ['organization' => 'organization', 'labelId' => 'label_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

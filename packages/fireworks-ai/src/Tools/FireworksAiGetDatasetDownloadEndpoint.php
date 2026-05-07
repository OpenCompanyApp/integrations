<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Dataset Download Endpoint.
 */
class FireworksAiGetDatasetDownloadEndpoint extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_dataset_download_endpoint';
    protected const DESCRIPTION = 'Get Dataset Download Endpoint.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/datasets/{dataset_id}:getDownloadEndpoint';
    protected const PATH_PARAMS = ['account_id', 'dataset_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Dataset.
 */
class FireworksAiGetDataset extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_dataset';
    protected const DESCRIPTION = 'Get Dataset.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/datasets/{dataset_id}';
    protected const PATH_PARAMS = ['account_id', 'dataset_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

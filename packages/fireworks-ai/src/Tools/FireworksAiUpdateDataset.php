<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Update Dataset.
 */
class FireworksAiUpdateDataset extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_update_dataset';
    protected const DESCRIPTION = 'Update Dataset.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/datasets/{dataset_id}';
    protected const PATH_PARAMS = ['account_id', 'dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}

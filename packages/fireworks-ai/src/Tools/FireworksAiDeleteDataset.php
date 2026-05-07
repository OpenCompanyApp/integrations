<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Dataset.
 */
class FireworksAiDeleteDataset extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_dataset';
    protected const DESCRIPTION = 'Delete Dataset.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/datasets/{dataset_id}';
    protected const PATH_PARAMS = ['account_id', 'dataset_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

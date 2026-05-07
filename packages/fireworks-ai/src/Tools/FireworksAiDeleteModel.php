<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Model.
 */
class FireworksAiDeleteModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_model';
    protected const DESCRIPTION = 'Delete Model.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/models/{model_id}';
    protected const PATH_PARAMS = ['account_id', 'model_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

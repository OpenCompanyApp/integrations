<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Evaluator.
 */
class FireworksAiDeleteEvaluator extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_evaluator';
    protected const DESCRIPTION = 'Delete Evaluator.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/evaluators/{evaluator_id}';
    protected const PATH_PARAMS = ['account_id', 'evaluator_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluator_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluator_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

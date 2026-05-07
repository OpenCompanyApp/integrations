<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Update Evaluator.
 */
class FireworksAiUpdateEvaluator extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_update_evaluator';
    protected const DESCRIPTION = 'Update Evaluator.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/evaluators/{evaluator_id}';
    protected const PATH_PARAMS = ['account_id', 'evaluator_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluator_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluator_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}

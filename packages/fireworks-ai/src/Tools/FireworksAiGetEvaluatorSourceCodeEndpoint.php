<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Evaluator Source Code Endpoint.
 */
class FireworksAiGetEvaluatorSourceCodeEndpoint extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_evaluator_source_code_endpoint';
    protected const DESCRIPTION = 'Get Evaluator Source Code Endpoint.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/evaluators/{evaluator_id}:getSourceCodeSignedUrl';
    protected const PATH_PARAMS = ['account_id', 'evaluator_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluator_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluator_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

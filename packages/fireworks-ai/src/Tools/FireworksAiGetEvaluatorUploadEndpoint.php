<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Evaluator Upload Endpoint.
 */
class FireworksAiGetEvaluatorUploadEndpoint extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_evaluator_upload_endpoint';
    protected const DESCRIPTION = 'Get Evaluator Upload Endpoint.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/evaluators/{evaluator_id}:getUploadEndpoint';
    protected const PATH_PARAMS = ['account_id', 'evaluator_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluator_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluator_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}

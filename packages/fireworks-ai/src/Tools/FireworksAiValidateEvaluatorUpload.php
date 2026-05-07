<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Validate Evaluator Upload.
 */
class FireworksAiValidateEvaluatorUpload extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_validate_evaluator_upload';
    protected const DESCRIPTION = 'Validate Evaluator Upload.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/evaluators/{evaluator_id}:validateUpload';
    protected const PATH_PARAMS = ['account_id', 'evaluator_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluator_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluator_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}

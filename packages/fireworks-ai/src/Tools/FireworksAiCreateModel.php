<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create Model.
 */
class FireworksAiCreateModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_create_model';
    protected const DESCRIPTION = 'Create Model.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/models';
    protected const PATH_PARAMS = ['account_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}

<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create Response.
 */
class FireworksAiPostResponses extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_create_response';
    protected const DESCRIPTION = 'Create response.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/responses';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}

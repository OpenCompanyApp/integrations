<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Response.
 */
class FireworksAiGetResponse extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_response';
    protected const DESCRIPTION = 'Get Response.';
    protected const METHOD = 'GET';
    protected const PATH = '/inference/v1/responses/{response_id}';
    protected const PATH_PARAMS = ['response_id'];
    protected const PARAMETERS = ['response_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks response_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

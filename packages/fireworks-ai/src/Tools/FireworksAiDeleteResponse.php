<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Response.
 */
class FireworksAiDeleteResponse extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_response';
    protected const DESCRIPTION = 'Delete Response.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/inference/v1/responses/{response_id}';
    protected const PATH_PARAMS = ['response_id'];
    protected const PARAMETERS = ['response_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks response_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

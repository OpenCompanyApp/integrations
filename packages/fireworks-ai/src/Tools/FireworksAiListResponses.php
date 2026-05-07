<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Responses.
 */
class FireworksAiListResponses extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_responses';
    protected const DESCRIPTION = 'List Responses.';
    protected const METHOD = 'GET';
    protected const PATH = '/inference/v1/responses';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

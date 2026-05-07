<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Evaluators.
 */
class FireworksAiListEvaluators extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_evaluators';
    protected const DESCRIPTION = 'List Evaluators.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/evaluators';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

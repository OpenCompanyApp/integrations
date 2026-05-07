<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Evaluation Jobs.
 */
class FireworksAiListEvaluationJobs extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_evaluation_jobs';
    protected const DESCRIPTION = 'List Evaluation Jobs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/evaluationJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

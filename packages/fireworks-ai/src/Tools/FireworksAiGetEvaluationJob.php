<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Evaluation Job.
 */
class FireworksAiGetEvaluationJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_evaluation_job';
    protected const DESCRIPTION = 'Get Evaluation Job.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/evaluationJobs/{evaluation_job_id}';
    protected const PATH_PARAMS = ['account_id', 'evaluation_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluation_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluation_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

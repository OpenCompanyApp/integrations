<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Evaluation Job execution logs (stream log endpoint + tracing IDs)..
 */
class FireworksAiGetEvaluationJobLogEndpoint extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_evaluation_job_log_endpoint';
    protected const DESCRIPTION = 'Get Evaluation Job execution logs (stream log endpoint + tracing IDs)..';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/evaluationJobs/{evaluation_job_id}:getExecutionLogEndpoint';
    protected const PATH_PARAMS = ['account_id', 'evaluation_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluation_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluation_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

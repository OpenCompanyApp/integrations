<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Evaluation Job.
 */
class FireworksAiDeleteEvaluationJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_evaluation_job';
    protected const DESCRIPTION = 'Delete Evaluation Job.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/evaluationJobs/{evaluation_job_id}';
    protected const PATH_PARAMS = ['account_id', 'evaluation_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'evaluation_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks evaluation_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

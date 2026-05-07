<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Batch Inference Job.
 */
class FireworksAiGetBatchInferenceJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_batch_inference_job';
    protected const DESCRIPTION = 'Get Batch Inference Job.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/batchInferenceJobs/{batch_inference_job_id}';
    protected const PATH_PARAMS = ['account_id', 'batch_inference_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'batch_inference_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks batch_inference_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

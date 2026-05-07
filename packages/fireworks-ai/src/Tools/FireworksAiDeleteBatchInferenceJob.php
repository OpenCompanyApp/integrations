<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Batch Inference Job.
 */
class FireworksAiDeleteBatchInferenceJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_batch_inference_job';
    protected const DESCRIPTION = 'Delete Batch Inference Job.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/batchInferenceJobs/{batch_inference_job_id}';
    protected const PATH_PARAMS = ['account_id', 'batch_inference_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'batch_inference_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks batch_inference_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

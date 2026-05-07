<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Batch Inference Jobs.
 */
class FireworksAiListBatchInferenceJobs extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_batch_inference_jobs';
    protected const DESCRIPTION = 'List Batch Inference Jobs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/batchInferenceJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}

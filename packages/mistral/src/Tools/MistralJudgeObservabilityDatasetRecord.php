<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Run live judging on a Mistral observability dataset record.
 */
class MistralJudgeObservabilityDatasetRecord extends AbstractMistralTool
{
    protected const NAME = 'mistral_judge_observability_dataset_record';
    protected const DESCRIPTION = 'Run live judging on a Mistral observability dataset record.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/dataset-records/{dataset_record_id}/live-judging';
    protected const PATH_PARAMS = ['dataset_record_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_record_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_record_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}

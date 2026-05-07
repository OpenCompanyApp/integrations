<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Summarize a Braintrust dataset.
 */
class BraintrustSummarizeDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_summarize_dataset';
    protected const DESCRIPTION = 'Summarize records for a Braintrust dataset.';
    protected const PATH = '/v1/dataset/{dataset_id}/summarize';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.']];
}

<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Insert rows into a Braintrust dataset.
 */
class BraintrustInsertDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_insert_dataset';
    protected const DESCRIPTION = 'Insert records into a Braintrust dataset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dataset/{dataset_id}/insert';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Insert body matching Braintrust dataset insert schema.']];
}

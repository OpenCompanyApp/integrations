<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Fetch rows from a Braintrust dataset.
 */
class BraintrustFetchDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_fetch_dataset';
    protected const DESCRIPTION = 'Fetch records from a Braintrust dataset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dataset/{dataset_id}/fetch';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Fetch body with filters, cursor, limit, or ids.']];
}

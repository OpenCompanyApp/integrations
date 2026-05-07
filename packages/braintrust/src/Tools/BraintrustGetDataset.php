<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Retrieve a Braintrust dataset by ID.
 */
class BraintrustGetDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_get_dataset';
    protected const DESCRIPTION = 'Get a Braintrust dataset by dataset_id.';
    protected const PATH = '/v1/dataset/{dataset_id}';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.']];
}

<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Delete a Braintrust dataset.
 */
class BraintrustDeleteDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_delete_dataset';
    protected const DESCRIPTION = 'Delete a Braintrust dataset by dataset_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/dataset/{dataset_id}';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.']];
}

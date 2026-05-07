<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Patch a Braintrust dataset.
 */
class BraintrustUpdateDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_update_dataset';
    protected const DESCRIPTION = 'Patch a Braintrust dataset.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/dataset/{dataset_id}';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Patch body with fields to update.']];
}

<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create a Braintrust dataset.
 */
class BraintrustCreateDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_create_dataset';
    protected const DESCRIPTION = 'Create a Braintrust dataset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dataset';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Create dataset body, usually including project_id and name.']];
}

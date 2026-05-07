<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create a Braintrust function.
 */
class BraintrustCreateFunction extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_create_function';
    protected const DESCRIPTION = 'Create a Braintrust function, tool, scorer, or prompt-backed function.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/function';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Create function body matching the Braintrust API schema.']];
}

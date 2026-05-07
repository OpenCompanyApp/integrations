<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Invoke a Braintrust function by ID.
 */
class BraintrustInvokeFunction extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_invoke_function';
    protected const DESCRIPTION = 'Invoke a Braintrust function, tool, scorer, or prompt by function_id.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/function/{function_id}/invoke';
    protected const PATH_PARAMS = ['function_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['function_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust function UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Invoke body including input and optional version/environment fields.']];
}

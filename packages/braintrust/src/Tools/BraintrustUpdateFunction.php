<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Patch a Braintrust function.
 */
class BraintrustUpdateFunction extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_update_function';
    protected const DESCRIPTION = 'Patch a Braintrust function by function_id.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/function/{function_id}';
    protected const PATH_PARAMS = ['function_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['function_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust function UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Patch body with fields to update.']];
}

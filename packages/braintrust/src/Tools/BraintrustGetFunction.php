<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Retrieve a Braintrust function by ID.
 */
class BraintrustGetFunction extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_get_function';
    protected const DESCRIPTION = 'Get a Braintrust function by function_id.';
    protected const PATH = '/v1/function/{function_id}';
    protected const PATH_PARAMS = ['function_id'];
    protected const PARAMETERS = ['function_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust function UUID.']];
}

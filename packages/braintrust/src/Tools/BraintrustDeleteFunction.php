<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Delete a Braintrust function.
 */
class BraintrustDeleteFunction extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_delete_function';
    protected const DESCRIPTION = 'Delete a Braintrust function by function_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/function/{function_id}';
    protected const PATH_PARAMS = ['function_id'];
    protected const PARAMETERS = ['function_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust function UUID.']];
}

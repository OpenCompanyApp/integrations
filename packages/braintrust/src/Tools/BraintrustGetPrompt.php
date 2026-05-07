<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Retrieve a Braintrust prompt by ID.
 */
class BraintrustGetPrompt extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_get_prompt';
    protected const DESCRIPTION = 'Get a Braintrust prompt by prompt_id.';
    protected const PATH = '/v1/prompt/{prompt_id}';
    protected const PATH_PARAMS = ['prompt_id'];
    protected const PARAMETERS = ['prompt_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust prompt UUID.']];
}

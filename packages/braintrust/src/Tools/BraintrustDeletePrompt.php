<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Delete a Braintrust prompt.
 */
class BraintrustDeletePrompt extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_delete_prompt';
    protected const DESCRIPTION = 'Delete a Braintrust prompt by prompt_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/prompt/{prompt_id}';
    protected const PATH_PARAMS = ['prompt_id'];
    protected const PARAMETERS = ['prompt_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust prompt UUID.']];
}

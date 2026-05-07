<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Patch a Braintrust prompt.
 */
class BraintrustUpdatePrompt extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_update_prompt';
    protected const DESCRIPTION = 'Patch a Braintrust prompt by prompt_id.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/prompt/{prompt_id}';
    protected const PATH_PARAMS = ['prompt_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['prompt_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust prompt UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Patch body with fields to update.']];
}

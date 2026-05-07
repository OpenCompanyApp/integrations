<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create a Braintrust prompt.
 */
class BraintrustCreatePrompt extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_create_prompt';
    protected const DESCRIPTION = 'Create a Braintrust prompt. Existing prompts with the same slug may be returned unchanged by the API.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/prompt';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Create prompt body including project_id, name, slug, and prompt_data.']];
}

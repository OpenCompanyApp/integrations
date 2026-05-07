<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create or update a Braintrust prompt.
 */
class BraintrustUpsertPrompt extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_upsert_prompt';
    protected const DESCRIPTION = 'Create or update a Braintrust prompt with the official PUT /v1/prompt endpoint.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/prompt';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Upsert prompt body matching the Braintrust API schema.']];
}

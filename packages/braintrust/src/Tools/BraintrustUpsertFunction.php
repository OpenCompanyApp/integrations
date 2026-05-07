<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create or update a Braintrust function.
 */
class BraintrustUpsertFunction extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_upsert_function';
    protected const DESCRIPTION = 'Create or update a Braintrust function with PUT /v1/function.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/function';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Upsert function body matching the Braintrust API schema.']];
}

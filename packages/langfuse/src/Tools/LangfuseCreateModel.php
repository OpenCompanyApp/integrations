<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse model definition.
 */
class LangfuseCreateModel extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_model';
    protected const DESCRIPTION = 'Create a Langfuse model definition. The body object must match the official model creation schema.';
    protected const SERVICE_METHOD = 'createModel';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse model creation body.'],
    ];
}

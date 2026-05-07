<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse prompt version.
 */
class LangfuseCreatePrompt extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_prompt';
    protected const DESCRIPTION = 'Create a Langfuse v2 prompt version. The body object must match the official prompt creation schema.';
    protected const SERVICE_METHOD = 'createPrompt';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse prompt creation body.'],
    ];
}

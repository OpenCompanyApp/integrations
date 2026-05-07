<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse score.
 */
class LangfuseCreateScore extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_score';
    protected const DESCRIPTION = 'Create a Langfuse score. The body object must match the official score creation schema.';
    protected const SERVICE_METHOD = 'createScore';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse score creation body.'],
    ];
}

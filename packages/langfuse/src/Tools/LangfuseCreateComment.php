<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Create a Langfuse comment.
 */
class LangfuseCreateComment extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_create_comment';
    protected const DESCRIPTION = 'Create a Langfuse comment. The body object must match the official comment creation schema.';
    protected const SERVICE_METHOD = 'createComment';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse comment creation body.'],
    ];
}

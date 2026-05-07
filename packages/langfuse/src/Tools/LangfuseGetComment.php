<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse comment by ID.
 */
class LangfuseGetComment extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_comment';
    protected const DESCRIPTION = 'Retrieve a Langfuse comment by ID.';
    protected const SERVICE_METHOD = 'getComment';
    protected const MODE = 'id';
    protected const ID_KEY = 'comment_id';
    protected const PARAMETERS = [
        'comment_id' => ['type' => 'string', 'required' => true, 'description' => 'Comment ID.'],
    ];
}

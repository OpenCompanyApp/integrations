<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse session by ID.
 */
class LangfuseGetSession extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_session';
    protected const DESCRIPTION = 'Retrieve a Langfuse session by ID.';
    protected const SERVICE_METHOD = 'getSession';
    protected const MODE = 'id';
    protected const ID_KEY = 'session_id';
    protected const PARAMETERS = [
        'session_id' => ['type' => 'string', 'required' => true, 'description' => 'Session ID.'],
    ];
}

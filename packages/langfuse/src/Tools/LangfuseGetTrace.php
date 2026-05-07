<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse trace by ID.
 */
class LangfuseGetTrace extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_trace';
    protected const DESCRIPTION = 'Retrieve a Langfuse trace by ID.';
    protected const SERVICE_METHOD = 'getTrace';
    protected const MODE = 'id';
    protected const ID_KEY = 'trace_id';
    protected const PARAMETERS = [
        'trace_id' => ['type' => 'string', 'required' => true, 'description' => 'Trace ID.'],
    ];
}

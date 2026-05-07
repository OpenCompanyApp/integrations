<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Delete a Langfuse trace by ID.
 */
class LangfuseDeleteTrace extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_delete_trace';
    protected const DESCRIPTION = 'Delete a Langfuse trace by ID.';
    protected const SERVICE_METHOD = 'deleteTrace';
    protected const MODE = 'id';
    protected const ID_KEY = 'trace_id';
    protected const PARAMETERS = [
        'trace_id' => ['type' => 'string', 'required' => true, 'description' => 'Trace ID to delete.'],
    ];
}

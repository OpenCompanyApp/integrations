<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Query Langfuse v2 metrics.
 */
class LangfuseMetrics extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_metrics';
    protected const DESCRIPTION = 'Query Langfuse v2 metrics. The body object must match the official metrics request schema.';
    protected const SERVICE_METHOD = 'metrics';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse v2 metrics request body.'],
    ];
}

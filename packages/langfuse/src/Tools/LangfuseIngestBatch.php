<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Submit tracing ingestion events to Langfuse.
 */
class LangfuseIngestBatch extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_ingest_batch';
    protected const DESCRIPTION = 'Submit a Langfuse ingestion batch. The body object must match the official /ingestion schema.';
    protected const SERVICE_METHOD = 'ingest';
    protected const MODE = 'body';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official Langfuse ingestion request body.'],
    ];
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Export Annotation Queue Archived Runs.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/annotation-queues/{queue_id}/export.
 */
class LangSmithExportAnnotationQueueArchivedRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_export_annotation_queue_archived_runs';
    protected const DESCRIPTION = 'Export Annotation Queue Archived Runs

Official endpoint: POST /api/v1/annotation-queues/{queue_id}/export
Export Annotation Queue Archived Runs.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/export';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Restart a backfill job.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/ops/backfills/restart.
 */
class LangSmithPostV1PlatformOpsBackfillsRestart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_ops_backfills_restart';
    protected const DESCRIPTION = 'Restart a backfill job

Official endpoint: POST /v1/platform/ops/backfills/restart
Deletes the backfill job record, causing the backfill to restart from the beginning on the next cron tick. Requires instance admin access.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/ops/backfills/restart';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

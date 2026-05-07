<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Bulk Unshare Entities.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/workspaces/current/shared.
 */
class LangSmithBulkUnshareEntities extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_bulk_unshare_entities';
    protected const DESCRIPTION = 'Bulk Unshare Entities

Official endpoint: DELETE /api/v1/workspaces/current/shared
Bulk unshare entities by share tokens for the workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/workspaces/current/shared';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

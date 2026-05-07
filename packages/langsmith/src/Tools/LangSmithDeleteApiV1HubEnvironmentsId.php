<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete hub environments model.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/hub/environments/{id}.
 */
class LangSmithDeleteApiV1HubEnvironmentsId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_api_v1_hub_environments_id';
    protected const DESCRIPTION = 'Delete hub environments model

Official endpoint: DELETE /api/v1/hub/environments/{id}
Deletes the hub environments configuration. Tenant reverts to defaults.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/hub/environments/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

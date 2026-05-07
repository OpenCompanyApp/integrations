<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update AI preferences.
 *
 * Maps to the official FireHydrant endpoint patch /v1/ai/preferences.
 */
class FireHydrantUpdateAiPreferences extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_ai_preferences';
    protected const DESCRIPTION = 'Update AI preferences

Official FireHydrant endpoint: PATCH /v1/ai/preferences

Updates the AI preferences';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/ai/preferences';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get AI preferences.
 *
 * Maps to the official FireHydrant endpoint get /v1/ai/preferences.
 */
class FireHydrantGetAiPreferences extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ai_preferences';
    protected const DESCRIPTION = 'Get AI preferences

Official FireHydrant endpoint: GET /v1/ai/preferences

Retrieves the current AI preferences';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ai/preferences';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

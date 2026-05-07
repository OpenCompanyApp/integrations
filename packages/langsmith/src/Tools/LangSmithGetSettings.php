<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Settings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/settings.
 */
class LangSmithGetSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_settings';
    protected const DESCRIPTION = 'Get Settings

Official endpoint: GET /api/v1/settings
Get settings.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

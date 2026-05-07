<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Playground Settings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/playground-settings.
 */
class LangSmithListPlaygroundSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_playground_settings';
    protected const DESCRIPTION = 'List Playground Settings

Official endpoint: GET /api/v1/playground-settings
Get all playground settings for this tenant id.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/playground-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

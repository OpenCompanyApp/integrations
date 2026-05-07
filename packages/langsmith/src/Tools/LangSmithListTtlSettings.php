<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Ttl Settings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/ttl-settings.
 */
class LangSmithListTtlSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_ttl_settings';
    protected const DESCRIPTION = 'List Ttl Settings

Official endpoint: GET /api/v1/ttl-settings
List out the configured TTL settings for a given tenant.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/ttl-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

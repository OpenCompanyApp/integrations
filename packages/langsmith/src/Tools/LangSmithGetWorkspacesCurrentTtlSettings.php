<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get workspace TTL settings.
 *
 * Maps to the official LangSmith endpoint GET /workspaces/current/ttl-settings.
 */
class LangSmithGetWorkspacesCurrentTtlSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_workspaces_current_ttl_settings';
    protected const DESCRIPTION = 'Get workspace TTL settings

Official endpoint: GET /workspaces/current/ttl-settings
Get the longlived trace TTL settings for a workspace';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/workspaces/current/ttl-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

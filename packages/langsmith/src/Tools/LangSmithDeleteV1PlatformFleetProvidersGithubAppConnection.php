<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete GitHub user connection.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/fleet/providers/github-app/connection.
 */
class LangSmithDeleteV1PlatformFleetProvidersGithubAppConnection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_fleet_providers_github_app_connection';
    protected const DESCRIPTION = 'Delete GitHub user connection

Official endpoint: DELETE /v1/platform/fleet/providers/github-app/connection
Remove the current user\'s GitHub connection and all linked installations.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/fleet/providers/github-app/connection';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

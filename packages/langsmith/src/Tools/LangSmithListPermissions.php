<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Permissions.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/permissions.
 */
class LangSmithListPermissions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_permissions';
    protected const DESCRIPTION = 'List Permissions

Official endpoint: GET /api/v1/orgs/permissions
List Permissions.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/permissions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

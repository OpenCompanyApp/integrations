<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Tags.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/tags.
 */
class LangSmithListTags extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_tags';
    protected const DESCRIPTION = 'List Tags

Official endpoint: GET /api/v1/workspaces/current/tags
List Tags.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/tags';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

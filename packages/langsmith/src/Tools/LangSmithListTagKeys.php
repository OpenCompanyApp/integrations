<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Tag Keys.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/tag-keys.
 */
class LangSmithListTagKeys extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_tag_keys';
    protected const DESCRIPTION = 'List Tag Keys

Official endpoint: GET /api/v1/workspaces/current/tag-keys
List Tag Keys.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/tag-keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

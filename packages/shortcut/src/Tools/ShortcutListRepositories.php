<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Repositories.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/repositories.
 */
class ShortcutListRepositories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_repositories';
    protected const DESCRIPTION = 'List Repositories

Official Shortcut endpoint: GET /api/v3/repositories.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/repositories';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Iterations.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/iterations.
 */
class ShortcutListIterations extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_iterations';
    protected const DESCRIPTION = 'List Iterations

Official Shortcut endpoint: GET /api/v3/iterations.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/iterations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Disable Iterations.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/iterations/disable.
 */
class ShortcutDisableIterations extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_disable_iterations';
    protected const DESCRIPTION = 'Disable Iterations

Official Shortcut endpoint: PUT /api/v3/iterations/disable.';
    protected const PARAMETERS = [];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/iterations/disable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Enable Iterations.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/iterations/enable.
 */
class ShortcutEnableIterations extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_enable_iterations';
    protected const DESCRIPTION = 'Enable Iterations

Official Shortcut endpoint: PUT /api/v3/iterations/enable.';
    protected const PARAMETERS = [];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/iterations/enable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

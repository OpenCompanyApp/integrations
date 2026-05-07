<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Objectives.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/objectives.
 */
class ShortcutListObjectives extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_objectives';
    protected const DESCRIPTION = 'List Objectives

Official Shortcut endpoint: GET /api/v3/objectives.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/objectives';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

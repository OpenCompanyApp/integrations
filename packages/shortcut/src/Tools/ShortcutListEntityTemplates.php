<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Entity Templates.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/entity-templates.
 */
class ShortcutListEntityTemplates extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_entity_templates';
    protected const DESCRIPTION = 'List Entity Templates

Official Shortcut endpoint: GET /api/v3/entity-templates.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/entity-templates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

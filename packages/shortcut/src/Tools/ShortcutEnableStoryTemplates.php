<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Enable Story Templates.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/entity-templates/enable.
 */
class ShortcutEnableStoryTemplates extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_enable_story_templates';
    protected const DESCRIPTION = 'Enable Story Templates

Official Shortcut endpoint: PUT /api/v3/entity-templates/enable.';
    protected const PARAMETERS = [];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/entity-templates/enable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

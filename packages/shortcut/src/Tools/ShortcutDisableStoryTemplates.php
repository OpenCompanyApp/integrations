<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Disable Story Templates.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/entity-templates/disable.
 */
class ShortcutDisableStoryTemplates extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_disable_story_templates';
    protected const DESCRIPTION = 'Disable Story Templates

Official Shortcut endpoint: PUT /api/v3/entity-templates/disable.';
    protected const PARAMETERS = [];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/entity-templates/disable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

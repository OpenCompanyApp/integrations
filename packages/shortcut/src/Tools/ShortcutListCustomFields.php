<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Custom Fields.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/custom-fields.
 */
class ShortcutListCustomFields extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_custom_fields';
    protected const DESCRIPTION = 'List Custom Fields

Official Shortcut endpoint: GET /api/v3/custom-fields.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/custom-fields';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

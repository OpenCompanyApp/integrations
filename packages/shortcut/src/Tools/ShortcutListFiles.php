<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Files.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/files.
 */
class ShortcutListFiles extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_files';
    protected const DESCRIPTION = 'List Files

Official Shortcut endpoint: GET /api/v3/files.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/files';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

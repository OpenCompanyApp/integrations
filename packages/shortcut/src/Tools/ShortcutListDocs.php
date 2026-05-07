<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Docs.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/documents.
 */
class ShortcutListDocs extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_docs';
    protected const DESCRIPTION = 'List Docs

Official Shortcut endpoint: GET /api/v3/documents.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/documents';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

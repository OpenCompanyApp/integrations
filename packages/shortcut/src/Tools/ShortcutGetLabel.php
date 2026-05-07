<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Label.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/labels/{label-public-id}.
 */
class ShortcutGetLabel extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_label';
    protected const DESCRIPTION = 'Get Label

Official Shortcut endpoint: GET /api/v3/labels/{label-public-id}.';
    protected const PARAMETERS = [
        'label_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Label.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/labels/{label-public-id}';
    protected const PATH_PARAMS = [
        'label-public-id' => 'label_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

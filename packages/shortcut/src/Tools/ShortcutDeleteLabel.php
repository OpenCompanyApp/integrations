<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Label.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/labels/{label-public-id}.
 */
class ShortcutDeleteLabel extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_label';
    protected const DESCRIPTION = 'Delete Label

Official Shortcut endpoint: DELETE /api/v3/labels/{label-public-id}.';
    protected const PARAMETERS = [
        'label_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Label.',
        ],
    ];
    protected const METHOD = 'DELETE';
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

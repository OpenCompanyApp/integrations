<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Label Epics.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/labels/{label-public-id}/epics.
 */
class ShortcutListLabelEpics extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_label_epics';
    protected const DESCRIPTION = 'List Label Epics

Official Shortcut endpoint: GET /api/v3/labels/{label-public-id}/epics.';
    protected const PARAMETERS = [
        'label_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Label.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/labels/{label-public-id}/epics';
    protected const PATH_PARAMS = [
        'label-public-id' => 'label_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

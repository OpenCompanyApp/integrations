<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Milestones.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/milestones.
 */
class ShortcutListMilestones extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_milestones';
    protected const DESCRIPTION = 'List Milestones

Official Shortcut endpoint: GET /api/v3/milestones.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/milestones';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

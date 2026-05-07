<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Create an Attio list. */
class AttioCreateList extends AbstractAttioTool
{
    protected const NAME = 'attio_create_list';
    protected const DESCRIPTION = 'Create a new Attio list for one or more parent objects.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/lists';
    protected const REQUIRED = ['name', 'api_slug', 'parent_object'];
    protected const BODY_KEYS = ['name', 'api_slug', 'parent_object', 'workspace_access', 'workspace_member_access'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'List name.'],
        'api_slug' => ['type' => 'string', 'required' => true, 'description' => 'List API slug.'],
        'parent_object' => ['type' => 'array', 'required' => true, 'description' => 'Parent object slug(s) or IDs allowed in the list.'],
        'workspace_access' => ['type' => 'string', 'description' => 'Workspace access level.'],
        'workspace_member_access' => ['type' => 'array', 'description' => 'Per-member access rules.'],
        'body' => ['type' => 'object', 'description' => 'Raw list body. If data is omitted, fields are wrapped as data.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Update an Attio list. */
class AttioUpdateList extends AbstractAttioTool
{
    protected const NAME = 'attio_update_list';
    protected const DESCRIPTION = 'Update list metadata and access controls for an Attio list.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/lists/{list_id}';
    protected const REQUIRED = ['list_id'];
    protected const BODY_KEYS = ['name', 'api_slug', 'workspace_access', 'workspace_member_access'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
        'name' => ['type' => 'string', 'description' => 'List name.'],
        'api_slug' => ['type' => 'string', 'description' => 'List API slug.'],
        'workspace_access' => ['type' => 'string', 'description' => 'Workspace access level.'],
        'workspace_member_access' => ['type' => 'array', 'description' => 'Per-member access rules.'],
        'body' => ['type' => 'object', 'description' => 'Raw list body. If data is omitted, fields are wrapped as data.'],
    ];
}

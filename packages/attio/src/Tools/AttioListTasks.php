<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** List Attio tasks. */
class AttioListTasks extends AbstractAttioTool
{
    protected const NAME = 'attio_list_tasks';
    protected const DESCRIPTION = 'List Attio tasks with optional record and completion filters.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/tasks';
    protected const QUERY_KEYS = ['limit', 'offset', 'linked_object', 'linked_record_id', 'assignee', 'is_completed'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum tasks to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'linked_object' => ['type' => 'string', 'description' => 'Linked object slug or ID.'],
        'linked_record_id' => ['type' => 'string', 'description' => 'Linked record UUID.'],
        'assignee' => ['type' => 'string', 'description' => 'Assignee actor/member filter when supported.'],
        'is_completed' => ['type' => 'boolean', 'description' => 'Completion filter.'],
    ];
}

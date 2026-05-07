<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Update an Attio task. */
class AttioUpdateTask extends AbstractAttioTool
{
    protected const NAME = 'attio_update_task';
    protected const DESCRIPTION = 'Update an Attio task by task ID.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/tasks/{task_id}';
    protected const REQUIRED = ['task_id'];
    protected const BODY_KEYS = ['content_plaintext', 'deadline_at', 'is_completed', 'linked_records', 'assignees'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'],
        'content_plaintext' => ['type' => 'string', 'description' => 'Task content.'],
        'deadline_at' => ['type' => 'string', 'description' => 'Deadline date or timestamp.'],
        'is_completed' => ['type' => 'boolean', 'description' => 'Completion state.'],
        'body' => ['type' => 'object', 'description' => 'Raw task body. If data is omitted, fields are wrapped as data.'],
    ];
}

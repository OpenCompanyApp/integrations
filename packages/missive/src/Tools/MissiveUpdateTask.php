<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Update a Missive task.
 */
class MissiveUpdateTask extends AbstractMissiveTool
{
    public const NAME = 'missive_update_task';
    public const DESCRIPTION = 'Update a Missive task by ID.';
    public const PARAMETERS = [
        'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Task attributes to update.'],
    ];

    /**
     * Update a task.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->updateTask($this->requiredString($args, 'task_id', 'task_id'), $body);
    }
}

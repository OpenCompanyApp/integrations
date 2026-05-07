<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Get a Missive task by ID.
 */
class MissiveGetTask extends AbstractMissiveTool
{
    public const NAME = 'missive_get_task';
    public const DESCRIPTION = 'Get a single Missive task by ID.';
    public const PARAMETERS = [
        'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'],
    ];

    /**
     * Get a task.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getTask($this->requiredString($args, 'task_id', 'task_id'));
    }
}

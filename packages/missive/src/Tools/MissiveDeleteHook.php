<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Delete a Missive webhook subscription.
 */
class MissiveDeleteHook extends AbstractMissiveTool
{
    public const NAME = 'missive_delete_hook';
    public const DESCRIPTION = 'Delete a Missive webhook subscription by ID.';
    public const PARAMETERS = [
        'hook_id' => ['type' => 'string', 'required' => true, 'description' => 'Hook UUID.'],
    ];

    /**
     * Delete a hook.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteHook($this->requiredString($args, 'hook_id', 'hook_id'));
    }
}

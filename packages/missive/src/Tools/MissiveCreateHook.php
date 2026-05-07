<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create a Missive webhook subscription.
 */
class MissiveCreateHook extends AbstractMissiveTool
{
    public const NAME = 'missive_create_hook';
    public const DESCRIPTION = 'Create a Missive webhook subscription.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Webhook subscription payload.'],
    ];

    /**
     * Create a hook.
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

        return $this->service->createHook($body);
    }
}

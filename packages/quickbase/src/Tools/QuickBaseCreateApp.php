<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Create a Quickbase app.
 */
class QuickBaseCreateApp extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_create_app';
    public const DESCRIPTION = 'Create a Quickbase app using the REST API app creation payload.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'App creation payload.'],
    ];

    /**
     * Create an app.
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

        return $this->service->createApp($body);
    }
}

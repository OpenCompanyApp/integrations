<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Create a Quickbase table in an app.
 */
class QuickBaseCreateTable extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_create_table';
    public const DESCRIPTION = 'Create a table in a Quickbase app.';
    public const PARAMETERS = [
        'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Table creation payload.'],
    ];

    /**
     * Create a table.
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

        return $this->service->createTable($this->requiredString($args, 'appId', 'appId'), $body);
    }
}

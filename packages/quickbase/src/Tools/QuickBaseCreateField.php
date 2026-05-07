<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Create a field in a Quickbase table.
 */
class QuickBaseCreateField extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_create_field';
    public const DESCRIPTION = 'Create a field in a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Field creation payload.'],
    ];

    /**
     * Create a field.
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

        return $this->service->createField($this->requiredString($args, 'tableId', 'tableId'), $body);
    }
}

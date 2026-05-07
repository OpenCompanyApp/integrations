<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a field in a Baserow table.
 */
class BaserowCreateField extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_create_field';
    }

    public function description(): string
    {
        return 'Create a field in a Baserow table. Requires an account token with schema permissions.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Field payload, for example {"name":"Status","type":"single_select"}.'],
        ];
    }

    /**
     * Create a Baserow field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createField(
            $this->requiredInt($args, 'table_id'),
            $this->arrayArg($args, 'payload')
        ));
    }
}

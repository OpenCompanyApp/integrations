<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Baserow field definition.
 */
class BaserowUpdateField extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_update_field';
    }

    public function description(): string
    {
        return 'Update a Baserow field definition. Requires an account token with schema permissions.';
    }

    public function parameters(): array
    {
        return [
            'field_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow field ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Field update payload.'],
        ];
    }

    /**
     * Update a Baserow field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateField(
            $this->requiredInt($args, 'field_id'),
            $this->arrayArg($args, 'payload')
        ));
    }
}

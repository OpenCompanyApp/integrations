<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a field from a Baserow table.
 */
class BaserowDeleteField extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_delete_field';
    }

    public function description(): string
    {
        return 'Delete a Baserow field by field ID. This removes the field and its values.';
    }

    public function parameters(): array
    {
        return [
            'field_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow field ID.'],
        ];
    }

    /**
     * Delete a Baserow field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteField($this->requiredInt($args, 'field_id')));
    }
}

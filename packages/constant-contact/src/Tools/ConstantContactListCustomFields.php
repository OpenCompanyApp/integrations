<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * List Constant Contact contact custom fields.
 */
class ConstantContactListCustomFields extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_list_custom_fields';
    }

    public function description(): string
    {
        return 'List Constant Contact contact custom fields.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listCustomFields();
    }
}

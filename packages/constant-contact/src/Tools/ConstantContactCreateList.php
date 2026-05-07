<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Create a Constant Contact contact list.
 */
class ConstantContactCreateList extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_create_list';
    }

    public function description(): string
    {
        return 'Create a Constant Contact contact list.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'List name.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->createList($this->stringArg($args, 'name'));
    }
}

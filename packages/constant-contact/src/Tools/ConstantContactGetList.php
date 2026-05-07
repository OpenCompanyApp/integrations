<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get a Constant Contact contact list by ID.
 */
class ConstantContactGetList extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_list';
    }

    public function description(): string
    {
        return 'Get a Constant Contact contact list by ID.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact list ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getList($this->stringArg($args, 'list_id'));
    }
}

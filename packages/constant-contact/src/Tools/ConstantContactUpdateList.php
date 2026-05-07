<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Update a Constant Contact contact list.
 */
class ConstantContactUpdateList extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_update_list';
    }

    public function description(): string
    {
        return 'Update a Constant Contact contact list.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact list ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Contact list payload.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->updateList($this->stringArg($args, 'list_id'), $this->params($args, 'payload'));
    }
}

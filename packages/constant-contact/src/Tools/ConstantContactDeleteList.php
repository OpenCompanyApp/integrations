<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Delete a Constant Contact contact list.
 */
class ConstantContactDeleteList extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_delete_list';
    }

    public function description(): string
    {
        return 'Delete a Constant Contact contact list.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact list ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->deleteList($this->stringArg($args, 'list_id'));
    }
}

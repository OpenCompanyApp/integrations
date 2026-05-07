<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * List Constant Contact contact tags.
 */
class ConstantContactListTags extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_list_tags';
    }

    public function description(): string
    {
        return 'List Constant Contact contact tags.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listTags();
    }
}

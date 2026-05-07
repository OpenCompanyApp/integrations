<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get a Constant Contact contact activity summary report.
 */
class ConstantContactGetContactActivitySummary extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_contact_activity_summary';
    }

    public function description(): string
    {
        return 'Get recent campaign activity summary for a contact.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getContactActivitySummary($this->stringArg($args, 'contact_id'));
    }
}

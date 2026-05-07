<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get Constant Contact account summary details.
 */
class ConstantContactGetAccountSummary extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_account_summary';
    }

    public function description(): string
    {
        return 'Get Constant Contact account summary details.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional extra_fields such as physical_address,company_logo.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getAccountSummary($this->params($args));
    }
}

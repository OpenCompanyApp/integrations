<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get a Constant Contact bulk activity by ID.
 */
class ConstantContactGetActivity extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_activity';
    }

    public function description(): string
    {
        return 'Get status for a Constant Contact bulk activity.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'string', 'required' => true, 'description' => 'Bulk activity ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getActivity($this->stringArg($args, 'activity_id'));
    }
}

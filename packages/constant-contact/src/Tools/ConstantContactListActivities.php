<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * List Constant Contact bulk activities.
 */
class ConstantContactListActivities extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_list_activities';
    }

    public function description(): string
    {
        return 'List Constant Contact bulk activities.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional status filter.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listActivities($this->params($args));
    }
}

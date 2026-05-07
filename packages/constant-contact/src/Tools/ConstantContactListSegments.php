<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * List Constant Contact segments.
 */
class ConstantContactListSegments extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_list_segments';
    }

    public function description(): string
    {
        return 'List Constant Contact segments.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional limit, cursor, and status filters.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listSegments($this->params($args));
    }
}

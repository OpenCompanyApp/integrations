<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * List blocked-off times in Acuity Scheduling.
 */
class AcuityListBlocks extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_list_blocks';
    }

    public function description(): string
    {
        return 'List blocked-off times for the authenticated Acuity Scheduling user.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional block query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listBlocks(is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}

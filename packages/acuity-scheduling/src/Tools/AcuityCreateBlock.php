<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Create a blocked-off time in Acuity Scheduling.
 */
class AcuityCreateBlock extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_create_block';
    }

    public function description(): string
    {
        return 'Block off time on an Acuity Scheduling calendar.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Block body with date/time, calendar, and duration fields accepted by Acuity.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createBlock($this->arrayArg($args, 'body'));
    }
}

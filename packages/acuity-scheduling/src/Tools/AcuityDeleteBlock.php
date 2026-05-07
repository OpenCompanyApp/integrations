<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Delete a blocked-off time in Acuity Scheduling.
 */
class AcuityDeleteBlock extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_delete_block';
    }

    public function description(): string
    {
        return 'Delete a blocked-off time by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Block ID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->deleteBlock($this->intArg($args, 'id'));
    }
}

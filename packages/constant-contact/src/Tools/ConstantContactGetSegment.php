<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get a Constant Contact segment by ID.
 */
class ConstantContactGetSegment extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_segment';
    }

    public function description(): string
    {
        return 'Get a Constant Contact segment by ID.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getSegment($this->stringArg($args, 'segment_id'));
    }
}

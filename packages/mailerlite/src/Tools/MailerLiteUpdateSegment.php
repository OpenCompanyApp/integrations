<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a MailerLite segment.
 */
class MailerLiteUpdateSegment extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_update_segment';
    }

    public function description(): string
    {
        return 'Update a segment name.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated segment name.'],
        ];
    }

    /**
     * Execute the segment update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateSegment(
            $this->required($args, 'segment_id'),
            ['name' => $this->required($args, 'name')],
        ));
    }
}

<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a MailerLite segment.
 */
class MailerLiteDeleteSegment extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_segment';
    }

    public function description(): string
    {
        return 'Delete a segment by ID.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
        ];
    }

    /**
     * Execute the segment deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteSegment($this->required($args, 'segment_id')));
    }
}

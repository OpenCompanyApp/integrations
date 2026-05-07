<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscribers belonging to a MailerLite segment.
 */
class MailerLiteListSegmentSubscribers extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_segment_subscribers';
    }

    public function description(): string
    {
        return 'List subscribers in a segment with cursor pagination and status filtering.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
            'filter[status]' => ['type' => 'string', 'description' => 'Subscriber status filter.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a prior response.'],
        ];
    }

    /**
     * Execute the segment subscriber listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSegmentSubscribers(
            $this->required($args, 'segment_id'),
            $this->only($args, ['filter[status]', 'limit', 'cursor']),
        ));
    }
}

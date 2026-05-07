<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Validate LINE message objects.
 *
 * Validates messages for reply, push, multicast, narrowcast, or broadcast payloads.
 */
class LineValidateMessages implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_validate_messages';
    }

    public function description(): string
    {
        return 'Validate LINE message objects for a target send endpoint.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Validation type: reply, push, multicast, narrowcast, or broadcast.'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of LINE message objects to validate.'],
        ];
    }

    /**
     * Validate messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->validateMessages((string) ($args['type'] ?? ''), $args['messages'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

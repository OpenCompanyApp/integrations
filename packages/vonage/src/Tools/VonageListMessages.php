<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\Integrations\Vonage\VonageService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VonageListMessages implements Tool
{
    /**
     * Create a new VonageListMessages tool instance.
     */
    public function __construct(
        private VonageService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'vonage_list_messages';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Search and list SMS messages from your Vonage account. Requires a date in YYYY-MM-DD format. Optionally filter by recipient number.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'required' => true, 'description' => 'Date to search messages for, in YYYY-MM-DD format (e.g., "2025-01-15").'],
            'to' => ['type' => 'string', 'description' => 'Recipient phone number to filter by (E.164 format).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vonage integration is not configured.');
            }

            $params = [
                'date' => $args['date'],
            ];

            if (isset($args['to'])) {
                $params['to'] = $args['to'];
            }

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

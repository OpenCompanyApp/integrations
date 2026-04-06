<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single message from the RingCentral message store by ID.
 */
class RingCentralGetMessage implements Tool
{
    /**
     * Create a new RingCentralGetMessage tool instance.
     *
     * @param  RingCentralService  $service  The RingCentral API service.
     */
    public function __construct(
        private RingCentralService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'ringcentral_get_message';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific message in the RingCentral message store by its ID. Returns the full message record including sender, recipient, subject, and content.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the message record.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array  $args  The tool arguments matching parameter definitions.
     * @return ToolResult The result containing the message details or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RingCentral integration is not configured.');
            }

            if (empty($args['messageId'])) {
                return ToolResult::error('messageId is required.');
            }

            $result = $this->service->getMessage($args['messageId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

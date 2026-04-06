<?php

namespace OpenCompany\Integrations\Outreach\Tools;

use OpenCompany\Integrations\Outreach\OutreachService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OutreachGetSequence implements Tool
{
    /**
     * Create a new OutreachGetSequence tool instance.
     *
     * @param OutreachService $service The Outreach API service.
     */
    public function __construct(
        private OutreachService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'outreach_get_sequence';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a single sales sequence from Outreach by ID. Returns full sequence details including steps, settings, and associated metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The sequence ID.'],
        ];
    }

    /**
     * Execute the tool — get a single sequence from Outreach.
     *
     * @param  array $args The tool arguments (id required).
     * @return ToolResult The result containing the sequence data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Outreach integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Sequence ID is required.');
            }

            $result = $this->service->getSequence($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

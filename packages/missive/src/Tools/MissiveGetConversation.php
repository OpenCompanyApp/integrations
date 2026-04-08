<?php

namespace OpenCompany\Integrations\Missive\Tools;

use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: missive_get_conversation
 *
 * Retrieve a single conversation from Missive by its ID.
 */
class MissiveGetConversation implements Tool
{
    /**
     * @param  MissiveService  $service  The Missive API service instance.
     */
    public function __construct(
        private MissiveService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'missive_get_conversation';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a single Missive conversation by ID, including messages and metadata.';
    }

    /**
     * Define the accepted parameters.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation UUID.'],
        ];
    }

    /**
     * Execute the tool — get a single conversation from Missive.
     *
     * @param  array<string, mixed>  $args  The input parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Missive integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('Conversation ID is required.');
            }

            $result = $this->service->getConversation($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

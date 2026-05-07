<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * JinaAIGround — Ground a statement against provided context.
 *
 * Accepts a statement and verifies it using Jina AI's Grounding endpoint.
 *
 * @see https://jina.ai/api/#grounding
 */
class JinaAIGround implements Tool
{
    /**
     * @param  JinaAIService  $service  The Jina AI service instance
     */
    public function __construct(
        private JinaAIService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'jinaai_ground';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Ground a statement against provided context using Jina AI. Verifies whether a claim or statement is supported by the given reference text. Returns grounding results indicating which parts of the statement are supported or contradicted.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'statement' => ['type' => 'string', 'required' => true, 'description' => 'The statement or claim to verify.'],
            'references' => ['type' => 'array', 'description' => 'Optional references or URLs to restrict grounding sources.'],
            'context' => ['type' => 'string', 'description' => 'Deprecated compatibility field. Prefer references when restricting sources.'],
        ];
    }

    /**
     * Execute the grounding tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (must contain 'statement')
     * @return ToolResult The grounding results
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            $statement = $args['statement'] ?? null;
            if (! is_string($statement) || $statement === '') {
                return ToolResult::error('statement must be a non-empty string.');
            }

            $body = [
                'statement' => $statement,
            ];

            if (isset($args['references'])) {
                $body['references'] = $args['references'];
            }

            if (isset($args['context'])) {
                $body['context'] = $args['context'];
            }

            $result = $this->service->ground($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

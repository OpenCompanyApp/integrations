<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Convert Cohere tokenizer IDs back to text.
 *
 * Uses the tokenizer for the supplied model through the v1 Detokenize endpoint.
 */
class CohereDetokenize extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_detokenize';
    }

    public function description(): string
    {
        return 'Convert Cohere model token IDs back to text with the tokenizer used by a specific model.';
    }

    public function parameters(): array
    {
        return [
            'tokens' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'integer'], 'description' => 'Token integer IDs to detokenize.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model whose tokenizer should be used.'],
        ];
    }

    /**
     * Execute the Cohere Detokenize API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing tokens and model.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->detokenize([
                'tokens' => $this->requireIntegerList($args, 'tokens'),
                'model' => $this->requireString($args, 'model'),
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

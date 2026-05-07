<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Split text into tokens using a Cohere model tokenizer.
 *
 * Returns token integer IDs and token strings from the v1 Tokenize endpoint.
 */
class CohereTokenize extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_tokenize';
    }

    public function description(): string
    {
        return 'Tokenize text with the tokenizer used by a Cohere model. Use this before budgeting prompts or debugging token boundaries.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Text to tokenize.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model whose tokenizer should be used.'],
        ];
    }

    /**
     * Execute the Cohere Tokenize API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing text and model.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->tokenize([
                'text' => $this->requireString($args, 'text'),
                'model' => $this->requireString($args, 'model'),
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

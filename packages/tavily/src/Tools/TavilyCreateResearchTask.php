<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Queue an asynchronous Tavily Research task.
 *
 * Covers the documented JSON research task creation endpoint, including
 * model choice, output schema, and citation format. Streaming is rejected
 * explicitly because tool execution expects a JSON response.
 */
class TavilyCreateResearchTask extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_create_research_task';
    }

    public function description(): string
    {
        return 'Create a Tavily Research task for comprehensive multi-source research. The returned request_id can be passed to tavily_get_research_task.';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => 'string', 'required' => true, 'description' => 'Research question or task to investigate.'],
            'model' => ['type' => 'string', 'enum' => ['mini', 'pro', 'auto'], 'description' => 'Research agent model. mini is targeted, pro is comprehensive, auto lets Tavily choose.'],
            'output_schema' => ['type' => 'object', 'description' => 'Optional JSON Schema with properties and optional required fields for structured output.'],
            'citation_format' => ['type' => 'string', 'enum' => ['numbered', 'mla', 'apa', 'chicago'], 'description' => 'Citation format for the research report.'],
            'stream' => ['type' => 'boolean', 'description' => 'Not supported by this tool. Tavily streaming returns SSE rather than JSON.'],
        ];
    }

    /**
     * Execute the Tavily Research task creation API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Tavily Research request parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tavily integration is not configured.');
            }

            if (($args['stream'] ?? false) === true) {
                return ToolResult::error('stream=true is not supported by this tool because Tavily returns a Server-Sent Events stream. Create a non-streaming task and poll it with tavily_get_research_task.');
            }

            $this->assertEnum('model', $args['model'] ?? null, ['mini', 'pro', 'auto']);
            $this->assertEnum('citation_format', $args['citation_format'] ?? null, ['numbered', 'mla', 'apa', 'chicago']);

            $payload = $this->only($args, [
                'input',
                'model',
                'output_schema',
                'citation_format',
            ]);
            $payload['input'] = $this->requireString($args, 'input');

            return ToolResult::success($this->service->createResearch($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

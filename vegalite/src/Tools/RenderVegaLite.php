<?php

namespace OpenCompany\Integrations\VegaLite\Tools;

use Illuminate\Support\Str;
use OpenCompany\Integrations\VegaLite\VegaLiteService;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderVegaLite implements Tool
{
    public function __construct(
        private VegaLiteService $vegaLiteService,
        private ?AgentFileStorage $fileStorage = null,
        private ?object $agent = null,
    ) {}

    public function description(): string
    {
        return <<<'DESC'
Render a Vega-Lite visualization to a PNG image. Pass a complete Vega-Lite JSON specification and get back a markdown image embed.

IMPORTANT: Always use inline data with "data": {"values": [...]}. Never use "data": {"url": "..."}.

Example spec:
{
  "$schema": "https://vega.github.io/schema/vega-lite/v5.json",
  "data": {"values": [
    {"category": "A", "value": 28},
    {"category": "B", "value": 55},
    {"category": "C", "value": 43}
  ]},
  "mark": "bar",
  "encoding": {
    "x": {"field": "category", "type": "nominal"},
    "y": {"field": "value", "type": "quantitative"}
  }
}

Supported mark types: bar, line, point, area, rect, circle, square, arc, text, tick, rule, trail, boxplot.
Always include "type" in encoding channels: "quantitative", "nominal", "ordinal", or "temporal".
DESC;
    }

    public function name(): string
    {
        return 'render_vegalite';
    }

    public function parameters(): array
    {
        return [
            'spec' => ['type' => 'string', 'required' => true, 'description' => 'Complete Vega-Lite JSON specification. Must include "data" with inline "values", "mark" type, and "encoding". Always use {"data": {"values": [...]}} for data.'],
            'title' => ['type' => 'string', 'description' => 'Chart title used as alt text (default: "Chart").'],
            'width' => ['type' => 'integer', 'description' => 'Output width in pixels (default: 800, range: 200–4000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $spec = trim($args['spec'] ?? '');
        if (empty($spec)) {
            return ToolResult::error('Vega-Lite JSON specification is required. Pass your chart JSON in the "spec" parameter.');
        }

        // Validate it's valid JSON
        json_decode($spec);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ToolResult::error('Invalid JSON in spec — ' . json_last_error_msg());
        }

        $title = $args['title'] ?? 'Chart';
        $width = (int) ($args['width'] ?? 800);

        try {
            if ($this->fileStorage && $this->agent) {
                $bytes = $this->vegaLiteService->renderToBytes($spec, $width);
                $filename = Str::uuid()->toString() . '.png';
                $result = $this->fileStorage->saveFile($this->agent, $filename, $bytes, 'image/png', 'vegalite');

                return ToolResult::success("![{$title}]({$result['url']})");
            }

            $url = $this->vegaLiteService->render($spec, $width);

            return ToolResult::success("![{$title}]({$url})");
        } catch (\Throwable $e) {
            return ToolResult::error('Error rendering Vega-Lite chart: ' . $e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Mermaid\Tools;

use Illuminate\Support\Str;
use OpenCompany\Integrations\Mermaid\MermaidService;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderMermaid implements Tool
{
    public function __construct(
        private MermaidService $mermaidService,
        private ?AgentFileStorage $fileStorage = null,
        private ?object $agent = null,
    ) {}

    public function name(): string
    {
        return 'render_mermaid';
    }

    public function description(): string
    {
        return <<<'DESC'
Render a Mermaid diagram to a PNG image. Pass valid Mermaid syntax and get back a markdown image embed.

Supported diagram types: flowchart, sequence, class, state, ER, Gantt, pie, quadrant, requirement, git graph, C4, mindmap, timeline, sankey, XY chart, block.

Example syntax:
```
graph TD
    A[Start] --> B{Decision}
    B -->|Yes| C[Action]
    B -->|No| D[End]
```

Tips:
- Use `graph TD` for top-down flowcharts, `graph LR` for left-to-right
- Use `sequenceDiagram` for sequence diagrams
- Use `erDiagram` for entity-relationship diagrams
- Use `classDiagram` for class diagrams
- Use `stateDiagram-v2` for state diagrams
- Use `gantt` for Gantt charts
- Use `pie` for pie charts
- Use `gitgraph` for git graphs
- Use `mindmap` for mind maps
DESC;
    }

    public function parameters(): array
    {
        return [
            'syntax' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Mermaid diagram syntax. Must be valid Mermaid markup (e.g., starting with graph TD, sequenceDiagram, erDiagram, etc.).',
            ],
            'title' => [
                'type' => 'string',
                'description' => 'Diagram title used as alt text (default: "Diagram").',
            ],
            'width' => [
                'type' => 'integer',
                'description' => 'Output width in pixels (default: 1400, range: 100-4000).',
            ],
            'theme' => [
                'type' => 'string',
                'description' => "Mermaid theme (default: 'default').",
                'enum' => ['default', 'dark', 'forest', 'neutral'],
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $syntax = trim($args['syntax'] ?? '');
        if (empty($syntax)) {
            return ToolResult::error('Mermaid syntax is required. Pass your diagram code in the "syntax" parameter.');
        }

        $title = $args['title'] ?? 'Diagram';
        $width = (int) ($args['width'] ?? 1400);
        $theme = $args['theme'] ?? 'default';

        $allowedThemes = ['default', 'dark', 'forest', 'neutral'];
        if (! in_array($theme, $allowedThemes, true)) {
            $theme = 'default';
        }

        try {
            if ($this->fileStorage && $this->agent) {
                $bytes = $this->mermaidService->renderToBytes($syntax, $width, $theme);
                $filename = Str::uuid()->toString() . '.png';
                $result = $this->fileStorage->saveFile($this->agent, $filename, $bytes, 'image/png', 'mermaid');

                return ToolResult::success("![{$title}]({$result['url']})");
            }

            $url = $this->mermaidService->render($syntax, $width, $theme);

            return ToolResult::success("![{$title}]({$url})");
        } catch (\Throwable $e) {
            return ToolResult::error('Rendering failed: ' . $e->getMessage());
        }
    }
}

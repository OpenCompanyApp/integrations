<?php

namespace OpenCompany\Integrations\PlantUml\Tools;

use Illuminate\Support\Str;
use OpenCompany\Integrations\PlantUml\PlantUmlService;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderPlantUml implements Tool
{
    public function __construct(
        private PlantUmlService $plantUmlService,
        private ?AgentFileStorage $fileStorage = null,
        private ?object $agent = null,
    ) {}

    public function description(): string
    {
        return <<<'DESC'
Render a PlantUML diagram to a PNG image. Pass valid PlantUML syntax and get back a markdown image embed.

Supported diagram types: class, sequence, activity, component, state, use case, object, deployment, timing, network (nwdiag), wireframe (salt), Gantt, mindmap, WBS, JSON, YAML, ERD.

Example syntax:
```
@startuml
Alice -> Bob: Authentication Request
Bob --> Alice: Authentication Response
Alice -> Bob: Another request
Bob --> Alice: Another response
@enduml
```

Tips:
- Always wrap syntax in @startuml / @enduml
- Use `->` for solid arrows, `-->` for dashed arrows
- Use `class ClassName { }` blocks for class diagrams
- Use `(*) -->` for activity diagram start
- Use `[Component]` for component diagrams
- Use `state "Name" as s1` for state diagrams
DESC;
    }

    public function name(): string
    {
        return 'render_plantuml';
    }

    public function parameters(): array
    {
        return [
            'syntax' => ['type' => 'string', 'required' => true, 'description' => 'PlantUML diagram syntax. Should be wrapped in @startuml/@enduml (auto-wrapped if missing).'],
            'title' => ['type' => 'string', 'description' => 'Diagram title used as alt text (default: "Diagram").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $syntax = trim($args['syntax'] ?? '');
        if (empty($syntax)) {
            return ToolResult::error('PlantUML syntax is required. Pass your diagram code in the "syntax" parameter.');
        }

        // Auto-wrap in @startuml/@enduml if not present
        if (! str_contains($syntax, '@startuml')) {
            $syntax = "@startuml\n{$syntax}\n@enduml";
        }

        $title = $args['title'] ?? 'Diagram';

        try {
            if ($this->fileStorage && $this->agent) {
                $bytes = $this->plantUmlService->renderToBytes($syntax);
                $filename = Str::uuid()->toString() . '.png';
                $result = $this->fileStorage->saveFile($this->agent, $filename, $bytes, 'image/png', 'plantuml');

                return ToolResult::success("![{$title}]({$result['url']})");
            }

            $url = $this->plantUmlService->render($syntax);

            return ToolResult::success("![{$title}]({$url})");
        } catch (\Throwable $e) {
            return ToolResult::error('Error rendering PlantUML diagram: ' . $e->getMessage());
        }
    }
}

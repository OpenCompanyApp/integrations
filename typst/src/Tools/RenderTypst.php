<?php

namespace OpenCompany\Integrations\Typst\Tools;

use Illuminate\Support\Str;
use OpenCompany\Integrations\Typst\TypstService;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderTypst implements Tool
{
    public function __construct(
        private TypstService $typstService,
        private ?AgentFileStorage $fileStorage = null,
        private ?object $agent = null,
    ) {}

    public function description(): string
    {
        return <<<'DESC'
Render a Typst document to PDF. Pass valid Typst markup and get back a downloadable PDF link.

Use this tool to generate formatted documents: reports, invoices, proposals, summaries, letters, tables, and more.

Example markup:
```
#set page(margin: 2cm)
#set text(size: 11pt)

= Quarterly Report

== Summary

Revenue increased by *15%* compared to last quarter.

#table(
  columns: (1fr, 1fr, 1fr),
  [*Metric*], [*Q1*], [*Q2*],
  [Revenue], [$1.2M], [$1.38M],
  [Users], [12,000], [15,400],
)
```

Key Typst syntax:
- `= Heading` for headings (`==` for h2, `===` for h3)
- `*bold*` for bold, `_italic_` for italic
- `#table(columns: ..., [...], [...])` for tables
- `#set page(margin: 2cm)` for page settings
- `#set text(size: 12pt, font: "...")` for text settings
- `- item` for bullet lists, `+ item` for numbered lists
- `#line(length: 100%)` for horizontal rules
- `#align(center)[...]` for alignment
- `#v(1em)` for vertical spacing
DESC;
    }

    public function name(): string
    {
        return 'render_typst';
    }

    public function parameters(): array
    {
        return [
            'markup' => ['type' => 'string', 'required' => true, 'description' => 'Typst markup content to compile into a PDF document.'],
            'title' => ['type' => 'string', 'description' => 'Document title used as link text (default: "Document").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $markup = trim($args['markup'] ?? '');
        if (empty($markup)) {
            return ToolResult::error('Typst markup is required. Pass your document content in the "markup" parameter.');
        }

        $title = $args['title'] ?? 'Document';

        try {
            if ($this->fileStorage && $this->agent) {
                $bytes = $this->typstService->renderToBytes($markup);
                $filename = Str::uuid()->toString() . '.pdf';
                $result = $this->fileStorage->saveFile($this->agent, $filename, $bytes, 'application/pdf', 'typst');

                return ToolResult::success("![{$title}]({$result['url']})");
            }

            $url = $this->typstService->render($markup);

            return ToolResult::success("![{$title}]({$url})");
        } catch (\Throwable $e) {
            return ToolResult::error('Error rendering Typst document: ' . $e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

/**
 * Export AssemblyAI subtitles in SRT or VTT format.
 */
class AssemblyAIGetSubtitles implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI API client.
     */
    public function __construct(private AssemblyAIService $service) {}

    public function name(): string
    {
        return 'assemblyai_get_subtitles';
    }

    public function description(): string
    {
        return 'Export a completed transcript as SRT or VTT subtitle text.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Transcript ID.'],
            'format' => ['type' => 'string', 'description' => 'Subtitle format: srt or vtt. Defaults to srt.'],
            'chars_per_caption' => ['type' => 'integer', 'description' => 'Maximum characters per caption.'],
        ];
    }

    /**
     * Retrieve subtitle text for a transcript.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            $params = [];
            if (isset($args['chars_per_caption'])) {
                $params['chars_per_caption'] = (int) $args['chars_per_caption'];
            }

            return ToolResult::success($this->service->getSubtitles((string) ($args['id'] ?? ''), (string) ($args['format'] ?? 'srt'), $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

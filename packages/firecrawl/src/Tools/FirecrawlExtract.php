<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Extract structured data from one or more URLs using AI.
 *
 * Given a list of URLs and an optional prompt or JSON schema,
 * Firecrawl uses AI to extract the requested data from the
 * page content and returns it in a structured format.
 */
class FirecrawlExtract implements Tool
{
    public function __construct(
        private FirecrawlService $service,
    ) {}

    public function name(): string
    {
        return 'firecrawl_extract';
    }

    public function description(): string
    {
        return 'Extract structured data from one or more URLs using AI. Provide a prompt describing what to extract, or a JSON schema for the expected output format. Ideal for pulling specific data points from web pages.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'urls' => ['type' => 'array', 'required' => true, 'description' => 'List of URLs to extract data from (e.g., ["https://example.com/about"]).'],
            'prompt' => ['type' => 'string', 'description' => 'Natural language description of what data to extract from the pages.'],
            'schema' => ['type' => 'object', 'description' => 'JSON schema defining the expected output structure. The response will conform to this schema.'],
            'systemPrompt' => ['type' => 'string', 'description' => 'System prompt to guide the AI extraction behavior.'],
            'allowExternalLinks' => ['type' => 'boolean', 'description' => 'Allow following links to external domains during extraction. Default: false.'],
            'enableWebSearch' => ['type' => 'boolean', 'description' => 'Enable web search to supplement extraction with additional context. Default: false.'],
            'includeSubdomains' => ['type' => 'boolean', 'description' => 'Include subdomains when following links. Default: false.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $urls = $args['urls'];
            if (!is_array($urls) || empty($urls)) {
                return ToolResult::error('urls must be a non-empty array of URL strings.');
            }

            $options = [];

            if (isset($args['prompt'])) {
                $options['prompt'] = $args['prompt'];
            }
            if (isset($args['schema'])) {
                $options['schema'] = $args['schema'];
            }
            if (isset($args['systemPrompt'])) {
                $options['systemPrompt'] = $args['systemPrompt'];
            }
            if (isset($args['allowExternalLinks'])) {
                $options['allowExternalLinks'] = (bool) $args['allowExternalLinks'];
            }
            if (isset($args['enableWebSearch'])) {
                $options['enableWebSearch'] = (bool) $args['enableWebSearch'];
            }
            if (isset($args['includeSubdomains'])) {
                $options['includeSubdomains'] = (bool) $args['includeSubdomains'];
            }

            $result = $this->service->extract($urls, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

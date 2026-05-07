<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

/**
 * Generate a PDF from a public URL.
 *
 * Converts a web page with optional PDF rendering settings through APITemplate.io.
 */
class ApiTemplateIOCreatePdfFromUrl implements Tool
{
    /**
     * @param  ApiTemplateIOService  $service  The APITemplate.io API client
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    public function name(): string
    {
        return 'apitemplateio_create_pdf_from_url';
    }

    public function description(): string
    {
        return 'Generate a PDF by rendering a public URL with optional page settings.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'Public URL to render into a PDF.'],
            'settings' => ['type' => 'object', 'description' => 'PDF rendering settings such as paper_size, orientation, margins, headers, and footers.'],
            'export_type' => ['type' => 'string', 'description' => 'Return mode: json or file.', 'enum' => ['json', 'file']],
            'output_format' => ['type' => 'string', 'description' => 'Output format: pdf, html, png, or jpeg.', 'enum' => ['pdf', 'html', 'png', 'jpeg']],
            'expiration' => ['type' => 'integer', 'description' => 'Minutes until generated file URLs expire.'],
            'filename' => ['type' => 'string', 'description' => 'Optional generated filename.'],
            'async' => ['type' => 'boolean', 'description' => 'Generate asynchronously. Requires webhook_url when true.'],
            'webhook_url' => ['type' => 'string', 'description' => 'Webhook URL for asynchronous callbacks.'],
            'webhook_method' => ['type' => 'string', 'description' => 'Webhook method: GET or POST.', 'enum' => ['GET', 'POST']],
            'meta' => ['type' => 'string', 'description' => 'Optional external reference ID.'],
        ];
    }

    /**
     * Generate a PDF from a URL.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $url = (string) ($args['url'] ?? '');
            if ($url === '') {
                return ToolResult::error('The "url" parameter is required.');
            }

            $settings = $args['settings'] ?? [];
            if (! is_array($settings)) {
                return ToolResult::error('The "settings" parameter must be an object when provided.');
            }

            return ToolResult::success($this->service->createPdfFromUrl($url, $settings, $this->queryParams($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    private function queryParams(array $args): array
    {
        $params = [];
        foreach (['export_type', 'output_format', 'filename', 'webhook_url', 'webhook_method', 'meta'] as $key) {
            if (isset($args[$key])) {
                $params[$key] = $args[$key];
            }
        }
        if (isset($args['expiration'])) {
            $params['expiration'] = (int) $args['expiration'];
        }
        if (isset($args['async'])) {
            $params['async'] = $args['async'] ? '1' : '0';
        }

        return $params;
    }
}

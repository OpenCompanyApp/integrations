<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

/**
 * Generate a PDF directly from HTML content.
 *
 * Supports dynamic Jinja2 variables through the data object and APITemplate.io rendering settings.
 */
class ApiTemplateIOCreatePdfFromHtml implements Tool
{
    /**
     * @param  ApiTemplateIOService  $service  The APITemplate.io API client
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    public function name(): string
    {
        return 'apitemplateio_create_pdf_from_html';
    }

    public function description(): string
    {
        return 'Generate a PDF from raw HTML, optional CSS, dynamic data, and rendering settings.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'string', 'required' => true, 'description' => 'HTML body content. Jinja2 variables can reference keys from data.'],
            'css' => ['type' => 'string', 'description' => 'Optional CSS, usually including a style tag.'],
            'data' => ['type' => 'object', 'description' => 'Values for dynamic variables in the HTML body.'],
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
     * Generate a PDF from HTML.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $body = (string) ($args['body'] ?? '');
            if ($body === '') {
                return ToolResult::error('The "body" parameter is required.');
            }

            $data = $args['data'] ?? [];
            $settings = $args['settings'] ?? [];
            if (! is_array($data) || ! is_array($settings)) {
                return ToolResult::error('The "data" and "settings" parameters must be objects when provided.');
            }

            return ToolResult::success($this->service->createPdfFromHtml(
                $body,
                (string) ($args['css'] ?? ''),
                $data,
                $settings,
                $this->queryParams($args),
            ));
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

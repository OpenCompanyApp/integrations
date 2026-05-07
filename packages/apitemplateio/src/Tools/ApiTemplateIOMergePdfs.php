<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

/**
 * Merge multiple PDF files into one PDF.
 *
 * Accepts normal HTTP URLs or PDF data URLs and returns APITemplate.io merge output metadata.
 */
class ApiTemplateIOMergePdfs implements Tool
{
    /**
     * @param  ApiTemplateIOService  $service  The APITemplate.io API client
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    public function name(): string
    {
        return 'apitemplateio_merge_pdfs';
    }

    public function description(): string
    {
        return 'Merge multiple PDF URLs or PDF data URLs into a single PDF.';
    }

    public function parameters(): array
    {
        return [
            'urls' => ['type' => 'array', 'required' => true, 'description' => 'PDF URLs or data URLs to merge in order.'],
            'export_type' => ['type' => 'string', 'description' => 'Return mode: json or file.', 'enum' => ['json', 'file']],
            'expiration' => ['type' => 'integer', 'description' => 'Minutes until the generated merged PDF URL expires.'],
            'cloud_storage' => ['type' => 'integer', 'description' => 'Upload output to APITemplate.io CDN. 1 by default, 0 when BYOS handles storage.'],
            'meta' => ['type' => 'string', 'description' => 'Optional external reference ID.'],
            'postaction_enabled' => ['type' => 'string', 'description' => 'Enable post actions: 1 or 0.'],
            'postaction_s3_filekey' => ['type' => 'string', 'description' => 'Override post-action object key without file extension.'],
            'postaction_s3_bucket' => ['type' => 'string', 'description' => 'Override post-action bucket or container.'],
        ];
    }

    /**
     * Merge PDFs.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $urls = $args['urls'] ?? [];
            if (! is_array($urls) || $urls === []) {
                return ToolResult::error('The "urls" parameter must be a non-empty array.');
            }

            return ToolResult::success($this->service->mergePdfs($urls, $this->bodyParams($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    private function bodyParams(array $args): array
    {
        $params = [];
        foreach (['export_type', 'expiration', 'cloud_storage', 'meta', 'postaction_enabled', 'postaction_s3_filekey', 'postaction_s3_bucket'] as $key) {
            if (isset($args[$key])) {
                $params[$key] = $args[$key];
            }
        }

        return $params;
    }
}

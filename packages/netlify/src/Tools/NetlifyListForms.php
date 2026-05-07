<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List forms for a Netlify site.
 */
class NetlifyListForms implements Tool
{
    /**
     * @param  NetlifyService  $service  The Netlify REST API client.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_list_forms';
    }

    public function description(): string
    {
        return 'List all forms for a Netlify site. Returns form IDs, names, paths, and submission counts.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site identifier.'],
        ];
    }

    /**
     * List and normalize forms for a site.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $result = $this->service->listForms($siteId);

            $forms = array_map(function (array $form): array {
                return [
                    'id' => $form['id'] ?? null,
                    'site_id' => $form['site_id'] ?? null,
                    'name' => $form['name'] ?? null,
                    'paths' => $form['paths'] ?? [],
                    'submission_count' => $form['submission_count'] ?? 0,
                    'created_at' => $form['created_at'] ?? null,
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'forms' => $forms,
                'total' => count($forms),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

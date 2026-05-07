<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get Cloudflare zone analytics.
 *
 * Normalizes the dashboard analytics response into compact totals and series.
 */
class CloudflareGetAnalytics implements Tool
{
    /**
     * @param  CloudflareService  $service  Cloudflare API client.
     */
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_get_analytics';
    }

    public function description(): string
    {
        return 'Get analytics dashboard data for a Cloudflare zone. Returns HTTP requests, bandwidth, threats, and pageview metrics over a time range.';
    }

    public function parameters(): array
    {
        return [
            'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'The zone identifier.'],
            'since' => ['type' => 'string', 'description' => 'Start time: ISO 8601 date or relative offset like "-30d", "-7d", "-24h". Default: "-30d".'],
            'until' => ['type' => 'string', 'description' => 'End time: ISO 8601 date or "now". Default: "now".'],
            'continuous' => ['type' => 'string', 'description' => 'Whether to include continuous data ("true" or "false"). Default: "true".'],
        ];
    }

    /**
     * Fetch analytics for a zone.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudflare integration is not configured.');
            }

            $zoneId = $args['zone_id'] ?? '';
            if (empty($zoneId)) {
                return ToolResult::error('zone_id is required.');
            }

            $since = $args['since'] ?? '-30d';
            $until = $args['until'] ?? 'now';
            $continuous = $args['continuous'] ?? 'true';

            $result = $this->service->getAnalytics($zoneId, $since, $until, $continuous);

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $data = $result['result'] ?? [];

            $totals = $data['totals'] ?? [];
            $timeseries = $data['timeseries'] ?? [];

            $response = [
                'query' => $data['query'] ?? [],
                'totals' => [
                    'requests' => $totals['requests']['all'] ?? null,
                    'bandwidth' => $totals['bandwidth']['all'] ?? null,
                    'threats' => $totals['threats']['all'] ?? null,
                    'pageviews' => $totals['pageviews']['all'] ?? null,
                ],
                'timeseries_count' => count($timeseries),
            ];

            if (!empty($timeseries)) {
                $response['timeseries'] = array_map(function (array $entry): array {
                    return [
                        'until' => $entry['until'] ?? null,
                        'requests' => $entry['requests']['all'] ?? null,
                        'bandwidth' => $entry['bandwidth']['all'] ?? null,
                        'threats' => $entry['threats']['all'] ?? null,
                        'pageviews' => $entry['pageviews']['all'] ?? null,
                    ];
                }, $timeseries);
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

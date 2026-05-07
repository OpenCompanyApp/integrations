<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * Query NASA DONKI space-weather event endpoints.
 */
class NasaGetDonkiEvents implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_donki_events';
    }

    public function description(): string
    {
        return 'Get DONKI space-weather events such as CME, CMEAnalysis, GST, IPS, FLR, SEP, MPC, RBE, HSS, WSAEnlilSimulations, or notifications.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'DONKI event type: CME, CMEAnalysis, GST, IPS, FLR, SEP, MPC, RBE, HSS, WSAEnlilSimulations, or notifications.'],
            'start_date' => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format.'],
            'end_date' => ['type' => 'string', 'description' => 'End date in YYYY-MM-DD format.'],
            'most_accurate_only' => ['type' => 'boolean', 'description' => 'CMEAnalysis filter for most accurate results.'],
            'complete_entry_only' => ['type' => 'boolean', 'description' => 'CMEAnalysis filter for complete entries.'],
            'speed' => ['type' => 'integer', 'description' => 'CMEAnalysis lower speed limit.'],
            'half_angle' => ['type' => 'integer', 'description' => 'CMEAnalysis lower half-angle limit.'],
            'catalog' => ['type' => 'string', 'description' => 'DONKI catalog filter where supported.'],
            'keyword' => ['type' => 'string', 'description' => 'DONKI keyword filter where supported.'],
            'location' => ['type' => 'string', 'description' => 'IPS location filter where supported.'],
            'notification_type' => ['type' => 'string', 'description' => 'Notification filter such as all, FLR, SEP, CME, IPS, MPC, GST, RBE, or report.'],
        ];
    }

    /**
     * Fetch DONKI events.
     *
     * @param  array<string, mixed>  $args  Tool arguments including type and optional filters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            $params = [
                'startDate' => $args['start_date'] ?? null,
                'endDate' => $args['end_date'] ?? null,
                'mostAccurateOnly' => isset($args['most_accurate_only']) ? ($args['most_accurate_only'] ? 'true' : 'false') : null,
                'completeEntryOnly' => isset($args['complete_entry_only']) ? ($args['complete_entry_only'] ? 'true' : 'false') : null,
                'speed' => $args['speed'] ?? null,
                'halfAngle' => $args['half_angle'] ?? null,
                'catalog' => $args['catalog'] ?? null,
                'keyword' => $args['keyword'] ?? null,
                'location' => $args['location'] ?? null,
                'type' => $args['notification_type'] ?? null,
            ];

            return ToolResult::success($this->service->getDonkiEvents(
                (string) $args['type'],
                array_filter($params, static fn (mixed $value): bool => $value !== null && $value !== ''),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

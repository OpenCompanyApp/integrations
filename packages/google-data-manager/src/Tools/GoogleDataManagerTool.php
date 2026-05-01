<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleDataManager\GoogleDataManagerService;

/**
 * Shared implementation for Google Data Manager tools.
 *
 * Provides common parameter definitions, confirmation guards, and execution
 * routing for event ingestion, audience ingestion, removals, status polling, and raw access.
 */
abstract class GoogleDataManagerTool implements Tool
{
    protected const ACTION = '';
    protected const NAME = '';
    protected const DESCRIPTION = '';

    /**
     * @param  GoogleDataManagerService  $service  The Google Data Manager API client
     */
    public function __construct(
        protected GoogleDataManagerService $service,
    ) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return match (static::ACTION) {
            'diagnostics' => [],
            'ingest_events' => $this->writeParameters([
                'destinations' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Destination objects for Google advertising products.'],
                'events' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Event resources. eventTimestamp is required by the API.'],
                'consent' => ['type' => 'object', 'description' => 'Request-level Consent object. User-level consent overrides this.'],
                'validate_only' => ['type' => 'boolean', 'description' => 'Validate only when supported.'],
            ]),
            'ingest_audience_members', 'remove_audience_members' => $this->writeParameters([
                'destinations' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Destination objects for Google advertising products.'],
                'audience_members' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'AudienceMember resources. Maximum 10,000 per request.'],
                'consent' => ['type' => 'object', 'description' => 'Request-level Consent object. User-level consent overrides this.'],
                'encoding' => ['type' => 'string', 'description' => 'Encoding enum for user-data uploads.'],
                'encryption_info' => ['type' => 'object', 'description' => 'EncryptionInfo object for encrypted uploads.'],
                'terms_of_service' => ['type' => 'object', 'description' => 'TermsOfService object, including Customer Match TOS status when required.'],
            ]),
            'retrieve_request_status' => [
                'request_id' => ['type' => 'string', 'required' => true, 'description' => 'Request ID returned by an ingest or remove call.'],
            ],
            'raw_request' => [
                'method' => ['type' => 'string', 'required' => true, 'enum' => ['GET', 'POST', 'PATCH', 'DELETE'], 'description' => 'HTTP method.'],
                'path' => ['type' => 'string', 'required' => true, 'description' => 'Data Manager v1 API path, e.g. /events:ingest.'],
                'body' => ['type' => 'object', 'description' => 'JSON request body.'],
                'query' => ['type' => 'object', 'description' => 'Query parameters.'],
                'confirm_execute' => ['type' => 'boolean', 'description' => 'Required for non-GET raw requests.'],
            ],
            default => [],
        };
    }

    /**
     * Execute the Google Data Manager tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (static::ACTION === 'diagnostics') {
                return ToolResult::success($this->service->diagnostics());
            }

            if (! $this->service->isConfigured()) {
                return ToolResult::error('Google Data Manager integration is not configured.');
            }

            return match (static::ACTION) {
                'ingest_events' => $this->confirmed($args, fn () => $this->service->ingestEvents($this->eventBody($args))),
                'ingest_audience_members' => $this->confirmed($args, fn () => $this->service->ingestAudienceMembers($this->audienceBody($args))),
                'remove_audience_members' => $this->confirmed($args, fn () => $this->service->removeAudienceMembers($this->audienceBody($args))),
                'retrieve_request_status' => ToolResult::success($this->service->retrieveRequestStatus($this->requiredString($args, 'request_id'))),
                'raw_request' => $this->rawRequest($args),
                default => ToolResult::error('Unsupported Google Data Manager tool action: ' . static::ACTION),
            };
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, array<string, mixed>>  $params
     * @return array<string, array<string, mixed>>
     */
    private function writeParameters(array $params): array
    {
        return $params + [
            'confirm_execute' => ['type' => 'boolean', 'description' => 'Required for live ingestion or removal.'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function eventBody(array $args): array
    {
        $body = [
            'destinations' => $this->requiredArray($args, 'destinations'),
            'events' => $this->requiredArray($args, 'events'),
        ];
        foreach (['consent' => 'consent', 'validate_only' => 'validateOnly'] as $arg => $field) {
            if (array_key_exists($arg, $args)) {
                $body[$field] = $arg === 'validate_only' ? (bool) $args[$arg] : $args[$arg];
            }
        }

        return $body;
    }

    /**
     * @return array<string, mixed>
     */
    private function audienceBody(array $args): array
    {
        $body = [
            'destinations' => $this->requiredArray($args, 'destinations'),
            'audienceMembers' => $this->requiredArray($args, 'audience_members'),
        ];
        foreach ([
            'consent' => 'consent',
            'validate_only' => 'validateOnly',
            'encoding' => 'encoding',
            'encryption_info' => 'encryptionInfo',
            'terms_of_service' => 'termsOfService',
        ] as $arg => $field) {
            if (array_key_exists($arg, $args)) {
                $body[$field] = $arg === 'validate_only' ? (bool) $args[$arg] : $args[$arg];
            }
        }

        return $body;
    }

    private function confirmed(array $args, callable $callback): ToolResult
    {
        if (($args['validate_only'] ?? false) === true) {
            return ToolResult::success($callback());
        }
        if (empty($args['confirm_execute'])) {
            return ToolResult::error('confirm_execute=true is required for live Google Data Manager ingestion or removal.');
        }

        return ToolResult::success($callback());
    }

    private function rawRequest(array $args): ToolResult
    {
        $method = strtoupper($this->requiredString($args, 'method'));
        if ($method !== 'GET' && empty($args['confirm_execute'])) {
            return ToolResult::error('confirm_execute=true is required for non-GET raw requests.');
        }

        return ToolResult::success($this->service->raw($method, $this->requiredString($args, 'path'), (array) ($args['body'] ?? []), (array) ($args['query'] ?? [])));
    }

    private function requiredString(array $args, string $key): string
    {
        $value = trim((string) ($args[$key] ?? ''));
        if ($value === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    /**
     * @return array<int|string, mixed>
     */
    private function requiredArray(array $args, string $key): array
    {
        $value = $args[$key] ?? null;
        if (! is_array($value) || $value === []) {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }
}

<?php

namespace OpenCompany\Integrations\ChurnZero;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for ChurnZero's HTTP API endpoint.
 *
 * ChurnZero's public HTTP API is action based: requests are sent to the
 * configured /i endpoint with appKey plus action-specific query parameters.
 */
class ChurnZeroService
{
    /**
     * @param  string  $appKey  ChurnZero application key.
     * @param  string  $endpoint  ChurnZero HTTP API endpoint, usually https://analytics.churnzero.net/i.
     */
    public function __construct(
        private string $appKey = '',
        private string $endpoint = 'https://analytics.churnzero.net/i',
    ) {
        $this->endpoint = $this->normalizeEndpoint($this->endpoint);
    }

    /**
     * Check whether the service has an application key.
     */
    public function isConfigured(): bool
    {
        return $this->appKey !== '';
    }

    /**
     * Set a ChurnZero account or contact attribute.
     *
     * @param  string  $entity  Either "account" or "contact".
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @param  string|null  $contactExternalId  Contact identifier from the source system.
     * @param  string  $name  Attribute name configured in ChurnZero.
     * @param  string|int|float|bool|null  $value  Attribute value to write.
     * @return array<string, mixed>
     */
    public function setAttribute(
        string $entity,
        string $accountExternalId,
        ?string $contactExternalId,
        string $name,
        string|int|float|bool|null $value,
    ): array {
        $params = $this->baseEntityParams('setAttribute', $entity, $accountExternalId, $contactExternalId);
        $params['name'] = $name;
        $params['value'] = $this->formatValue($value);

        return $this->sendAction($params);
    }

    /**
     * Set multiple ChurnZero attributes by issuing one documented setAttribute action per value.
     *
     * @param  string  $entity  Either "account" or "contact".
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @param  string|null  $contactExternalId  Contact identifier from the source system.
     * @param  array<string, mixed>  $attributes  Attribute name/value pairs.
     * @return array<string, mixed>
     */
    public function setAttributes(string $entity, string $accountExternalId, ?string $contactExternalId, array $attributes): array
    {
        if ($attributes === []) {
            throw new \RuntimeException('At least one ChurnZero attribute is required.');
        }

        $results = [];
        foreach ($attributes as $name => $value) {
            if (! is_string($name) || $name === '') {
                throw new \RuntimeException('ChurnZero attribute names must be non-empty strings.');
            }

            $results[$name] = $this->setAttribute($entity, $accountExternalId, $contactExternalId, $name, $value);
        }

        return [
            'status' => 'success',
            'entity' => $this->normalizeEntity($entity),
            'accountExternalId' => $accountExternalId,
            'contactExternalId' => $contactExternalId,
            'attribute_count' => count($results),
            'results' => $results,
        ];
    }

    /**
     * Track a ChurnZero event for an account and optionally a contact.
     *
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @param  string  $eventName  Event name; ChurnZero creates it if needed.
     * @param  string|null  $contactExternalId  Contact identifier from the source system.
     * @param  string|null  $description  Optional event description.
     * @param  int|float|null  $quantity  Optional numeric quantity for the event.
     * @param  array<string, mixed>  $customFields  Optional event custom fields.
     * @return array<string, mixed>
     */
    public function trackEvent(
        string $accountExternalId,
        string $eventName,
        ?string $contactExternalId = null,
        ?string $description = null,
        int|float|null $quantity = null,
        array $customFields = [],
    ): array {
        $params = [
            'action' => 'trackEvent',
            'accountExternalId' => $accountExternalId,
            'eventName' => $eventName,
        ];

        if ($contactExternalId !== null && $contactExternalId !== '') {
            $params['contactExternalId'] = $contactExternalId;
        }
        if ($description !== null && $description !== '') {
            $params['description'] = $description;
        }
        if ($quantity !== null) {
            $params['quantity'] = $quantity;
        }
        if ($customFields !== []) {
            $params['customfields'] = json_encode($customFields, JSON_THROW_ON_ERROR);
        }

        return $this->sendAction($params);
    }

    /**
     * Increment a numeric ChurnZero account or contact attribute.
     *
     * @param  string  $entity  Either "account" or "contact".
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @param  string|null  $contactExternalId  Contact identifier from the source system.
     * @param  string  $name  Numeric attribute name configured in ChurnZero.
     * @param  int|float  $value  Amount to add; may be negative.
     * @return array<string, mixed>
     */
    public function incrementAttribute(
        string $entity,
        string $accountExternalId,
        ?string $contactExternalId,
        string $name,
        int|float $value,
    ): array {
        $params = $this->baseEntityParams('incrementAttribute', $entity, $accountExternalId, $contactExternalId);
        $params['name'] = $name;
        $params['value'] = $value;

        return $this->sendAction($params);
    }

    /**
     * Delete a ChurnZero account by external ID.
     *
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @return array<string, mixed>
     */
    public function deleteAccount(string $accountExternalId): array
    {
        return $this->sendAction([
            'action' => 'deleteAccount',
            'accountExternalId' => $accountExternalId,
        ]);
    }

    /**
     * Delete a ChurnZero contact by account and contact external IDs.
     *
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @param  string  $contactExternalId  Contact identifier from the source system.
     * @return array<string, mixed>
     */
    public function deleteContact(string $accountExternalId, string $contactExternalId): array
    {
        return $this->sendAction([
            'action' => 'deleteContact',
            'accountExternalId' => $accountExternalId,
            'contactExternalId' => $contactExternalId,
        ]);
    }

    /**
     * Send a raw ChurnZero action to the configured /i endpoint.
     *
     * @param  array<string, mixed>  $params  Action query parameters excluding appKey.
     * @return array<string, mixed>
     */
    public function sendAction(array $params): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('ChurnZero app key is not configured.');
        }

        if (($params['action'] ?? '') === '') {
            throw new \RuntimeException('ChurnZero action is required.');
        }

        $query = array_filter(
            array_merge(['appKey' => $this->appKey], $params),
            static fn ($value): bool => $value !== null && $value !== ''
        );

        $response = $this->rawRequest($query);

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return [
            'status_code' => $response->status(),
            'body' => $response->body(),
        ];
    }

    /**
     * Send a GET request to the ChurnZero action endpoint.
     *
     * @param  array<string, mixed>  $query  Full query string including appKey.
     * @return Response
     */
    private function rawRequest(array $query): Response
    {
        try {
            $response = Http::acceptJson()
                ->timeout(30)
                ->get($this->endpoint, $query);

            if (! $response->successful()) {
                $body = $response->json() ?? $response->body();

                Log::error('ChurnZero API error.', [
                    'status' => $response->status(),
                    'endpoint' => $this->endpoint,
                    'action' => $query['action'] ?? null,
                    'body' => $body,
                ]);

                throw new \RuntimeException('ChurnZero API error (' . $response->status() . '): ' . (is_string($body) ? $body : json_encode($body)));
            }

            return $response;
        } catch (\Throwable $e) {
            if ($e instanceof \RuntimeException && str_starts_with($e->getMessage(), 'ChurnZero API error')) {
                throw $e;
            }

            Log::error('ChurnZero API connection error.', [
                'endpoint' => $this->endpoint,
                'action' => $query['action'] ?? null,
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException('Failed to connect to ChurnZero API: ' . $e->getMessage());
        }
    }

    /**
     * Build common action parameters for account/contact attribute operations.
     *
     * @param  string  $action  ChurnZero action name.
     * @param  string  $entity  Either "account" or "contact".
     * @param  string  $accountExternalId  Account identifier from the source system.
     * @param  string|null  $contactExternalId  Contact identifier from the source system.
     * @return array<string, mixed>
     */
    private function baseEntityParams(string $action, string $entity, string $accountExternalId, ?string $contactExternalId): array
    {
        $normalizedEntity = $this->normalizeEntity($entity);

        if ($normalizedEntity === 'contact' && ($contactExternalId === null || $contactExternalId === '')) {
            throw new \RuntimeException('contactExternalId is required for ChurnZero contact attributes.');
        }

        $params = [
            'action' => $action,
            'entity' => $normalizedEntity,
            'accountExternalId' => $accountExternalId,
        ];

        if ($contactExternalId !== null && $contactExternalId !== '') {
            $params['contactExternalId'] = $contactExternalId;
        }

        return $params;
    }

    /**
     * Normalize and validate ChurnZero entity values.
     */
    private function normalizeEntity(string $entity): string
    {
        $entity = strtolower($entity);
        if (! in_array($entity, ['account', 'contact'], true)) {
            throw new \RuntimeException('ChurnZero entity must be either account or contact.');
        }

        return $entity;
    }

    /**
     * Convert PHP scalar values into query-safe ChurnZero values.
     */
    private function formatValue(string|int|float|bool|null $value): string|int|float|null
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return $value;
    }

    /**
     * Normalize a configured endpoint or host to the HTTP API /i endpoint.
     */
    private function normalizeEndpoint(string $endpoint): string
    {
        $endpoint = rtrim($endpoint, '/');

        return str_ends_with($endpoint, '/i') ? $endpoint : $endpoint . '/i';
    }
}

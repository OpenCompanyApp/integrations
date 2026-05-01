#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Generate canonical X and X Ads integration packages.
 *
 * X organic tools come from the official X API OpenAPI document. X Ads tools
 * come from the official Postman collection published by X Developer Platform.
 */

$root = dirname(__DIR__);

const X_OPENAPI_URL = 'https://api.x.com/2/openapi.json';
const X_ADS_POSTMAN_URL = 'https://raw.githubusercontent.com/xdevplatform/postman-twitter-ads-api/master/TwitterAdsAPI_postman_collection_v2-1.json';

function getJson(string $url): array
{
    $json = file_get_contents($url);
    if ($json === false) {
        throw new RuntimeException("Unable to download {$url}");
    }

    $data = json_decode($json, true);
    if (!is_array($data)) {
        throw new RuntimeException("Invalid JSON from {$url}: " . json_last_error_msg());
    }

    return $data;
}

function ensureDir(string $dir): void
{
    if (!is_dir($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
        throw new RuntimeException("Unable to create {$dir}");
    }
}

function cleanDir(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }

    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST,
    );

    foreach ($items as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }
}

function writeFileChecked(string $path, string $content): void
{
    ensureDir(dirname($path));
    if (file_put_contents($path, $content) === false) {
        throw new RuntimeException("Unable to write {$path}");
    }
}

function snake(string $value): string
{
    $value = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $value) ?? $value;
    $value = preg_replace('/[^A-Za-z0-9]+/', '_', $value) ?? $value;
    $value = strtolower(trim($value, '_'));
    $value = preg_replace('/_+/', '_', $value) ?? $value;

    return $value;
}

function studly(string $value): string
{
    $parts = preg_split('/[^A-Za-z0-9]+/', snake($value)) ?: [];

    return implode('', array_map(
        static fn (string $part): string => ucfirst($part),
        array_filter($parts, static fn (string $part): bool => $part !== ''),
    ));
}

function humanize(string $value): string
{
    $words = preg_split('/[_\-\s\/]+/', snake($value)) ?: [];
    $known = [
        'api' => 'API',
        'dm' => 'DM',
        'id' => 'ID',
        'oauth' => 'OAuth',
        'url' => 'URL',
        'woeid' => 'WOEID',
    ];

    return implode(' ', array_map(
        static fn (string $word): string => $known[$word] ?? ucfirst($word),
        array_filter($words, static fn (string $word): bool => $word !== ''),
    ));
}

function exportArray(array $value, int $indent = 0): string
{
    $pad = str_repeat(' ', $indent);
    $innerPad = str_repeat(' ', $indent + 4);
    $isList = array_is_list($value);
    $lines = ['['];

    foreach ($value as $key => $item) {
        $line = $innerPad;
        if (!$isList) {
            $line .= var_export((string) $key, true) . ' => ';
        }

        if (is_array($item)) {
            $line .= exportArray($item, $indent + 4);
        } elseif (is_bool($item)) {
            $line .= $item ? 'true' : 'false';
        } elseif ($item === null) {
            $line .= 'null';
        } else {
            $line .= var_export($item, true);
        }

        $lines[] = $line . ',';
    }

    $lines[] = $pad . ']';

    return implode("\n", $lines);
}

function schemaType(array $schema): string
{
    $type = $schema['type'] ?? null;
    if (is_array($type)) {
        $type = $type[0] ?? 'mixed';
    }

    return match ($type) {
        'integer' => 'integer',
        'number' => 'number',
        'boolean' => 'boolean',
        'array' => 'array',
        'object' => 'object',
        default => 'string',
    };
}

function parameterSchema(array $parameter): array
{
    $schema = is_array($parameter['schema'] ?? null) ? $parameter['schema'] : [];
    $out = [
        'type' => schemaType($schema),
        'required' => (bool) ($parameter['required'] ?? false),
        'description' => trim((string) ($parameter['description'] ?? '')),
    ];

    if (isset($schema['enum']) && is_array($schema['enum'])) {
        $out['enum'] = array_values(array_filter($schema['enum'], 'is_scalar'));
    }

    if (($out['type'] ?? '') === 'array') {
        $out['items'] = ['type' => schemaType(is_array($schema['items'] ?? null) ? $schema['items'] : [])];
    }

    return $out;
}

function securityModes(array $operation): array
{
    $modes = [];
    foreach ($operation['security'] ?? [] as $securitySet) {
        if (!is_array($securitySet)) {
            continue;
        }
        foreach ($securitySet as $scheme => $_scopes) {
            $modes[] = match ($scheme) {
                'BearerToken' => 'bearer_token',
                'OAuth2UserToken' => 'oauth2_pkce',
                'UserToken' => 'oauth1a_user_context',
                default => snake((string) $scheme),
            };
        }
    }

    return array_values(array_unique($modes));
}

function securityScopes(array $operation): array
{
    $scopes = [];
    foreach ($operation['security'] ?? [] as $securitySet) {
        if (!is_array($securitySet)) {
            continue;
        }
        foreach ($securitySet as $schemeScopes) {
            if (is_array($schemeScopes)) {
                foreach ($schemeScopes as $scope) {
                    if (is_string($scope) && $scope !== '') {
                        $scopes[] = $scope;
                    }
                }
            }
        }
    }

    return array_values(array_unique($scopes));
}

function xRuntimeMode(array $operation): string
{
    $tags = $operation['tags'] ?? [];
    if (($operation['x-twitter-streaming'] ?? false) === true) {
        return 'stream';
    }
    if (in_array('Webhooks', $tags, true)) {
        return 'webhook_subscription';
    }
    if (in_array('Account Activity', $tags, true)) {
        return 'webhook_subscription';
    }
    if (in_array('Compliance', $tags, true) && str_contains(strtolower((string) ($operation['summary'] ?? '')), 'job')) {
        return 'async_job';
    }

    return 'request_response';
}

function destructive(string $method, string $operationId): bool
{
    if (strtoupper($method) === 'DELETE') {
        return true;
    }

    return (bool) preg_match('/\b(delete|remove|unfollow|unlike|unblock|unmute|hide|cancel|disable)\b/i', $operationId);
}

function writeType(string $method, string $operationId): string
{
    if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
        return 'write';
    }

    return destructive($method, $operationId) ? 'write' : 'read';
}

function generatedToolClass(string $namespace, string $baseClass, array $operation): string
{
    $class = $operation['class'];
    $slug = $operation['slug'];
    $description = $operation['description'];
    $parameters = exportArray($operation['parameters'], 4);
    $metadata = exportArray($operation['operation'], 4);

    return <<<PHP
<?php

namespace {$namespace}\\Tools;

/**
 * {$description}
 */
class {$class} extends {$baseClass}
{
    protected const SLUG = '{$slug}';

    protected const DESCRIPTION = '{$description}';

    protected const PARAMETERS = {$parameters};

    protected const OPERATION = {$metadata};
}

PHP;
}

function buildProviderTools(array $operations, string $fqcnPrefix, string $icon): array
{
    $tools = [];
    foreach ($operations as $operation) {
        $tools[$operation['slug']] = [
            'class' => $fqcnPrefix . '\\Tools\\' . $operation['class'],
            'type' => $operation['type'],
            'name' => $operation['name'],
            'description' => $operation['description'],
            'icon' => $icon,
            'parameters' => $operation['parameters'],
            'operation_id' => $operation['operation_id'],
            'operation' => [
                'method' => $operation['operation']['method'],
                'path' => $operation['operation']['path'],
                'tags' => $operation['operation']['tags'] ?? [],
            ],
            'auth_modes' => $operation['auth_modes'],
            'required_scopes' => $operation['required_scopes'],
            'required_access_tier' => $operation['required_access_tier'],
            'runtime_mode' => $operation['runtime_mode'],
            'destructive' => $operation['destructive'],
            'billing_sensitive' => $operation['billing_sensitive'],
            'docs_url' => $operation['docs_url'],
        ];
    }

    return $tools;
}

function generateXPackage(string $root, array $openapi): int
{
    $pkg = "{$root}/packages/x";
    ensureDir("{$pkg}/src/Tools");
    cleanDir("{$pkg}/src/Tools");

    $operations = [];
    $seenClasses = [];
    $seenSlugs = [];
    foreach ($openapi['paths'] ?? [] as $path => $pathItem) {
        if (!is_array($pathItem)) {
            continue;
        }
        foreach ($pathItem as $method => $operation) {
            if (!in_array(strtolower((string) $method), ['get', 'post', 'put', 'patch', 'delete'], true) || !is_array($operation)) {
                continue;
            }

            $operationId = (string) ($operation['operationId'] ?? snake($method . '_' . $path));
            $baseSlug = 'x_' . snake($operationId);
            $slug = $baseSlug;
            for ($i = 2; isset($seenSlugs[$slug]); $i++) {
                $slug = $baseSlug . '_' . $i;
            }
            $seenSlugs[$slug] = true;

            $class = 'X' . studly($operationId);
            for ($i = 2; isset($seenClasses[$class]); $i++) {
                $class = 'X' . studly($operationId) . $i;
            }
            $seenClasses[$class] = true;

            $parameters = [];
            $operationParameters = [];
            foreach ($operation['parameters'] ?? [] as $parameter) {
                if (!is_array($parameter) || !isset($parameter['name'], $parameter['in'])) {
                    continue;
                }
                $name = (string) $parameter['name'];
                $parameters[$name] = parameterSchema($parameter);
                $operationParameters[] = [
                    'name' => $name,
                    'in' => (string) $parameter['in'],
                    'required' => (bool) ($parameter['required'] ?? false),
                    'style' => $parameter['style'] ?? null,
                    'explode' => $parameter['explode'] ?? null,
                ];
            }

            if (isset($operation['requestBody'])) {
                $parameters['body'] = [
                    'type' => 'object',
                    'required' => (bool) ($operation['requestBody']['required'] ?? false),
                    'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                ];
            }

            $tags = array_values(array_filter($operation['tags'] ?? [], 'is_string'));
            $runtimeMode = xRuntimeMode($operation);
            $summary = trim((string) ($operation['summary'] ?? humanize($operationId)));
            $description = trim((string) ($operation['description'] ?? $summary));
            $description = preg_replace('/\s+/', ' ', strip_tags($description)) ?: $summary;
            $description = trim(substr($description, 0, 360));
            $requiredAccessTier = null;
            if (array_intersect($tags, ['Account Activity', 'Activity', 'Webhooks'])) {
                $requiredAccessTier = 'enterprise_or_approved_access';
            } elseif ($runtimeMode === 'stream') {
                $requiredAccessTier = 'paid_or_elevated_access';
            }

            $operations[] = [
                'slug' => $slug,
                'class' => $class,
                'operation_id' => $operationId,
                'name' => humanize($operationId),
                'description' => $summary !== '' ? $summary : $description,
                'parameters' => $parameters,
                'type' => writeType((string) $method, $operationId),
                'auth_modes' => securityModes($operation),
                'required_scopes' => securityScopes($operation),
                'required_access_tier' => $requiredAccessTier,
                'runtime_mode' => $runtimeMode,
                'destructive' => destructive((string) $method, $operationId),
                'billing_sensitive' => in_array('Usage', $tags, true) || str_contains(strtolower($operationId), 'search'),
                'docs_url' => 'https://docs.x.com/x-api',
                'operation' => [
                    'id' => $operationId,
                    'method' => strtoupper((string) $method),
                    'path' => (string) $path,
                    'parameters' => $operationParameters,
                    'has_body' => isset($operation['requestBody']),
                    'body_mode' => 'json',
                    'auth_modes' => securityModes($operation),
                    'required_scopes' => securityScopes($operation),
                    'runtime_mode' => $runtimeMode,
                    'tags' => $tags,
                ],
            ];
        }
    }

    foreach ($operations as $operation) {
        writeFileChecked(
            "{$pkg}/src/Tools/{$operation['class']}.php",
            generatedToolClass('OpenCompany\\Integrations\\X', 'XGeneratedTool', $operation),
        );
    }

    writeFileChecked("{$pkg}/src/Tools/XGeneratedTool.php", <<<'PHP'
<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Base class for generated X API operation tools.
 *
 * Concrete generated tools provide operation metadata through constants. This
 * class validates required arguments and delegates request execution to the
 * service, so every operation keeps one stable tool class without duplicating
 * HTTP plumbing.
 */
abstract class XGeneratedTool implements Tool
{
    protected const SLUG = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const OPERATION = [];

    /**
     * @param  XService  $service  The X API client
     */
    public function __construct(
        protected XService $service,
    ) {}

    public function name(): string
    {
        return static::SLUG;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the generated X API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        foreach (static::PARAMETERS as $key => $schema) {
            if (($schema['required'] ?? false) && (!array_key_exists($key, $args) || $args[$key] === '' || $args[$key] === null)) {
                return ToolResult::error("{$key} is required.");
            }
        }

        try {
            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
PHP);

    writeFileChecked("{$pkg}/src/XService.php", <<<'PHP'
<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use OpenCompany\IntegrationCore\Support\OAuth1Signer;

/**
 * HTTP client for the official X API.
 *
 * Executes generated operation metadata from the X OpenAPI spec and selects
 * the strongest configured authentication mode supported by each operation.
 */
class XService
{
    public function __construct(
        private string $bearerToken = '',
        private string $accessToken = '',
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $accessTokenSecret = '',
        private string $baseUrl = 'https://api.x.com/2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether any supported credential mode is configured.
     */
    public function isConfigured(): bool
    {
        return $this->bearerToken !== ''
            || $this->accessToken !== ''
            || ($this->apiKey !== '' && $this->apiSecret !== '' && $this->accessToken !== '' && $this->accessTokenSecret !== '');
    }

    /**
     * Execute one generated X API operation.
     *
     * @param  array<string, mixed>  $operation  Generated operation metadata
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>|string
     */
    public function executeOperation(array $operation, array $args): array|string
    {
        if (($operation['runtime_mode'] ?? 'request_response') === 'stream') {
            throw new \RuntimeException('This X endpoint is a streaming endpoint. It must be run by a host streaming runner, not as a single request-response tool call.');
        }

        [$url, $query, $body] = $this->prepareRequest($operation, $args);
        $method = strtoupper((string) ($operation['method'] ?? 'GET'));
        $bodyMode = (string) ($operation['body_mode'] ?? 'json');

        $http = Http::timeout(30);
        $headers = $this->authHeaders($operation, $method, $url, $query, $body, $bodyMode);
        if (!empty($headers)) {
            $http = $http->withHeaders($headers);
        }

        if ($bodyMode === 'form') {
            $http = $http->asForm();
        } else {
            $http = $http->acceptJson()->asJson();
        }

        $response = match ($method) {
            'GET' => $http->get($url, $query),
            'POST' => $http->post($this->urlWithQuery($url, $query), $body),
            'PUT' => $http->put($this->urlWithQuery($url, $query), $body),
            'PATCH' => $http->patch($this->urlWithQuery($url, $query), $body),
            'DELETE' => $http->delete($this->urlWithQuery($url, $query), $body),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };

        if (!$response->successful()) {
            $json = $response->json();
            $error = is_array($json)
                ? ($json['title'] ?? $json['detail'] ?? $json['error'] ?? json_encode($json))
                : $response->body();

            Log::error('X API error', [
                'status' => $response->status(),
                'operation' => $operation['id'] ?? null,
                'error' => $error,
            ]);

            throw new \RuntimeException('X API error (' . $response->status() . '): ' . (string) $error);
        }

        $json = $response->json();

        return is_array($json) ? $json : $response->body();
    }

    /**
     * Test credentials with a lightweight endpoint.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'error' => 'No X credentials are configured.'];
        }

        try {
            $operation = $this->accessToken !== '' || $this->accessTokenSecret !== ''
                ? [
                    'id' => 'getUsersMe',
                    'method' => 'GET',
                    'path' => '/2/users/me',
                    'parameters' => [],
                    'body_mode' => 'json',
                    'auth_modes' => ['oauth2_pkce', 'oauth1a_user_context'],
                    'runtime_mode' => 'request_response',
                ]
                : [
                    'id' => 'getUsersByUsername',
                    'method' => 'GET',
                    'path' => '/2/users/by/username/{username}',
                    'parameters' => [
                        ['name' => 'username', 'in' => 'path', 'required' => true],
                    ],
                    'body_mode' => 'json',
                    'auth_modes' => ['bearer_token'],
                    'runtime_mode' => 'request_response',
                ];
            $args = ($operation['id'] ?? '') === 'getUsersByUsername' ? ['username' => 'XDevelopers'] : [];
            $result = $this->executeOperation($operation, $args);
            $username = is_array($result) ? ($result['data']['username'] ?? 'XDevelopers') : 'unknown';

            return ['success' => true, 'message' => "Connected to X as @{$username}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @param  array<string, mixed>  $operation
     * @param  array<string, mixed>  $args
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>}
     */
    private function prepareRequest(array $operation, array $args): array
    {
        $path = (string) ($operation['path'] ?? '/');
        $query = [];
        $body = isset($args['body']) && is_array($args['body']) ? $args['body'] : [];

        foreach ($operation['parameters'] ?? [] as $parameter) {
            if (!is_array($parameter)) {
                continue;
            }

            $name = (string) ($parameter['name'] ?? '');
            if ($name === '' || !array_key_exists($name, $args)) {
                continue;
            }

            if (($parameter['in'] ?? '') === 'path') {
                $path = str_replace('{' . $name . '}', rawurlencode((string) $args[$name]), $path);
                continue;
            }

            if (($parameter['in'] ?? '') === 'query') {
                $query[$name] = $this->normalizeQueryValue($args[$name], $parameter);
            }
        }

        return [$this->operationUrl($path), $query, $body];
    }

    /**
     * @param  array<string, mixed>  $parameter
     */
    private function normalizeQueryValue(mixed $value, array $parameter): mixed
    {
        if (is_array($value) && (($parameter['explode'] ?? null) === false || ($parameter['style'] ?? null) !== 'deepObject')) {
            return implode(',', array_map('strval', $value));
        }

        return $value;
    }

    private function operationUrl(string $path): string
    {
        if (str_ends_with($this->baseUrl, '/2') && str_starts_with($path, '/2/')) {
            $path = substr($path, 2);
        }

        return $this->baseUrl . '/' . ltrim($path, '/');
    }

    /**
     * @param  array<string, mixed>  $query
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if (empty($query)) {
            return $url;
        }

        return $url . (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
    }

    /**
     * @param  array<string, mixed>  $operation
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $body
     * @return array<string, string>
     */
    private function authHeaders(array $operation, string $method, string $url, array $query, array $body, string $bodyMode): array
    {
        $modes = $operation['auth_modes'] ?? [];

        if (in_array('oauth1a_user_context', $modes, true) && $this->apiKey !== '' && $this->apiSecret !== '' && $this->accessToken !== '' && $this->accessTokenSecret !== '') {
            return [
                'Authorization' => OAuth1Signer::authorizationHeader(
                    method: $method,
                    url: $url,
                    queryParams: $query,
                    bodyParams: $bodyMode === 'form' ? $body : [],
                    consumerKey: $this->apiKey,
                    consumerSecret: $this->apiSecret,
                    token: $this->accessToken,
                    tokenSecret: $this->accessTokenSecret,
                ),
            ];
        }

        if (in_array('oauth2_pkce', $modes, true) && $this->accessToken !== '') {
            return ['Authorization' => 'Bearer ' . $this->accessToken];
        }

        if (in_array('bearer_token', $modes, true) && $this->bearerToken !== '') {
            return ['Authorization' => 'Bearer ' . $this->bearerToken];
        }

        throw new \RuntimeException('No configured credential matches this X operation. Required auth modes: ' . implode(', ', $modes));
    }
}
PHP);

    writeFileChecked("{$pkg}/src/XServiceProvider.php", <<<'PHP'
<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the canonical Twitter / X integration.
 *
 * Binds the generated X API service and registers all OpenAPI-backed tools
 * with the integration registry when the host exposes one.
 */
class XServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XService(
                bearerToken: $creds->get('x', 'bearer_token', ''),
                accessToken: $creds->get('x', 'access_token', ''),
                apiKey: $creds->get('x', 'api_key', ''),
                apiSecret: $creds->get('x', 'api_secret', ''),
                accessTokenSecret: $creds->get('x', 'access_token_secret', ''),
                baseUrl: $creds->get('x', 'base_url', 'https://api.x.com/2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XToolProvider());
        }
    }
}
PHP);

    $providerTools = exportArray(buildProviderTools($operations, 'OpenCompany\\Integrations\\X', 'simple-icons:x'), 8);
    $openApiVersion = (string) ($openapi['info']['version'] ?? 'unknown');
    $operationCount = count($operations);

    writeFileChecked("{$pkg}/src/XToolProvider.php", <<<PHP
<?php

namespace OpenCompany\Integrations\X;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides the canonical generated Twitter / X API integration.
 *
 * Tool metadata is generated from the official X OpenAPI document
 * ({$openApiVersion}) and intentionally covers every request operation in it.
 */
class XToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'x';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Twitter / X',
            'description' => 'Organic X API tools',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Twitter / X',
            'description' => 'Full generated coverage of the official X API for posts, users, DMs, lists, media, streams, webhooks, compliance, trends, spaces, and usage.',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://docs.x.com/x-api',
        ];
    }

    /**
     * Describe X auth and host capability metadata.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'multi_auth',
                'strategies' => ['bearer_token', 'oauth2_pkce', 'oauth1a_user_context'],
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token', 'web_redirect', 'local_redirect', 'pin_oauth1'],
                'requires_browser_for_setup' => true,
                'refreshable' => true,
                'token_keys' => ['bearer_token', 'access_token', 'access_token_secret'],
                'source' => [
                    'type' => 'openapi',
                    'url' => 'https://api.x.com/2/openapi.json',
                    'version' => '{$openApiVersion}',
                    'operation_count' => {$operationCount},
                ],
                'notes' => [
                    'Bearer tokens support app-only public read endpoints.',
                    'OAuth 2.0 PKCE user tokens support user-context reads and writes.',
                    'OAuth 1.0a user tokens are supported for endpoints that require UserToken security.',
                    'CLI setup is headless for stored/manual tokens and PIN-based OAuth 1.0a; OAuth 2.0 PKCE setup needs browser or local callback support.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_oauth_redirect',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_pin_oauth1',
                    'runtime_mode' => 'normal_except_streaming',
                ],
                'mcp_gateway' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'kosmokrator_gateway',
                    'runtime_mode' => 'request_response_tools',
                ],
            ],
            'runtime_requirements' => [
                [
                    'type' => 'host_capability',
                    'name' => 'streaming_runner',
                    'description' => 'Required for tools marked runtime_mode=stream.',
                ],
                [
                    'type' => 'host_capability',
                    'name' => 'public_webhook_endpoint',
                    'description' => 'Required for webhook and account-activity subscription operations.',
                ],
            ],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
                'mcp_gateway_supported' => true,
                'lua_supported' => true,
            ],
            'seo' => [
                'aliases' => ['twitter', 'twitter api', 'x api', 'tweets', 'posts'],
            ],
        ];
    }

    public function configSchema(): array
    {
        return \$this->credentialFields();
    }

    /**
     * Validate X credentials with a lightweight user-context call when possible.
     *
     * @param  array<string, mixed>  \$config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array \$config): array
    {
        \$service = new XService(
            bearerToken: (string) (\$config['bearer_token'] ?? ''),
            accessToken: (string) (\$config['access_token'] ?? ''),
            apiKey: (string) (\$config['api_key'] ?? ''),
            apiSecret: (string) (\$config['api_secret'] ?? ''),
            accessTokenSecret: (string) (\$config['access_token_secret'] ?? ''),
            baseUrl: (string) (\$config['base_url'] ?? 'https://api.x.com/2'),
        );

        return \$service->testConnection();
    }

    public function validationRules(): array
    {
        return [
            'bearer_token' => 'nullable|string',
            'access_token' => 'nullable|string',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'access_token_secret' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return {$providerTools};
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/x.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'bearer_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => false, 'hint' => 'App-only token for public read endpoints.'],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => false, 'hint' => 'OAuth 2.0 user-context token or OAuth 1.0a user token.'],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'OAuth 1.0a API Key', 'required' => false],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'OAuth 1.0a API Secret', 'required' => false],
            ['key' => 'access_token_secret', 'type' => 'secret', 'label' => 'OAuth 1.0a Access Token Secret', 'required' => false],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.x.com/2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a generated X tool with optional multi-account credentials.
     *
     * @param  class-string<Tool>  \$class  Tool class name
     * @param  array<string, mixed>  \$context  Runtime context
     */
    public function createTool(string \$class, array \$context = []): Tool
    {
        return new \$class(\$this->resolveService(\$context));
    }

    /**
     * Resolve the service for the default or named account.
     *
     * @param  array<string, mixed>  \$context
     */
    private function resolveService(array \$context = []): XService
    {
        \$account = \$context['account'] ?? null;

        if (\$account !== null) {
            \$creds = app(CredentialResolver::class);

            return new XService(
                bearerToken: \$creds->get('x', 'bearer_token', '', \$account),
                accessToken: \$creds->get('x', 'access_token', '', \$account),
                apiKey: \$creds->get('x', 'api_key', '', \$account),
                apiSecret: \$creds->get('x', 'api_secret', '', \$account),
                accessTokenSecret: \$creds->get('x', 'access_token_secret', '', \$account),
                baseUrl: \$creds->get('x', 'base_url', 'https://api.x.com/2', \$account),
            );
        }

        return app(XService::class);
    }
}
PHP);

    writeFileChecked("{$pkg}/composer.json", <<<'JSON'
{
    "name": "opencompanyapp/integration-x",
    "description": "Twitter / X integration for Laravel — generated coverage of the official X API.",
    "license": "MIT",
    "authors": [
        {
            "name": "OpenCompany",
            "homepage": "https://github.com/OpenCompanyApp"
        }
    ],
    "keywords": ["tools", "x", "twitter", "social", "posts", "opencompany"],
    "require": {
        "php": "^8.2",
        "opencompanyapp/integration-core": "^2.0 || @dev"
    },
    "replace": {
        "opencompanyapp/integration-twitter": "self.version",
        "opencompanyapp/ai-tool-twitter": "self.version"
    },
    "autoload": {
        "psr-4": {
            "OpenCompany\\Integrations\\X\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "OpenCompany\\Integrations\\X\\XServiceProvider"
            ]
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
JSON);

    writeFileChecked("{$pkg}/README.md", <<<MD
# Twitter / X Integration

Generated integration for the official X API. It covers {$operationCount} operations from X OpenAPI version `{$openApiVersion}`.

Use this package for organic X surfaces: posts, users, DMs, chat, lists, media, streams, webhooks, compliance, spaces, trends, communities, and usage. Advertising workflows belong in `opencompanyapp/integration-x-ads`.

## Authentication

- Bearer token for app-only public read endpoints.
- OAuth 2.0 user access token for user-context reads and writes.
- OAuth 1.0a API key/secret plus access token/secret for `UserToken` endpoints.

Streaming tools are exposed with `runtime_mode=stream` and require host streaming support.
Webhook/account-activity tools require a public callback endpoint.
MD);

    writeFileChecked("{$pkg}/lua-docs/x.md", <<<MD
# Twitter / X — Lua API Reference

This integration is generated from the official X OpenAPI document version `{$openApiVersion}` and exposes {$operationCount} X API operations.

## Authentication

Configure one or more credential modes:

- `bearer_token` for app-only public reads.
- `access_token` for OAuth 2.0 user-context operations.
- `api_key`, `api_secret`, `access_token`, and `access_token_secret` for OAuth 1.0a user-context operations.

Each tool carries `auth_modes`, `required_scopes`, and `runtime_mode` metadata in the generated catalog.

## Runtime Notes

- Tools marked `stream` require a host streaming runner.
- Tools marked `webhook_subscription` require a public callback endpoint.
- Enterprise or approved-access endpoints return clear API errors if the configured X account lacks access.

## Examples

```lua
local me = app.integrations.x.x_get_users_me({})
local user = app.integrations.x.x_get_users_by_username({ username = "XDevelopers" })
```

For multi-account hosts:

```lua
app.integrations.x.default.x_find_my_user({})
app.integrations.x.work.x_find_my_user({})
```
MD);

    return count($operations);
}

function collectPostmanRequests(array $items, array $folders = []): array
{
    $requests = [];
    foreach ($items as $item) {
        if (!is_array($item)) {
            continue;
        }

        if (isset($item['request']) && is_array($item['request'])) {
            $item['_folders'] = $folders;
            $requests[] = $item;
            continue;
        }

        if (isset($item['item']) && is_array($item['item'])) {
            $requests = array_merge($requests, collectPostmanRequests($item['item'], array_merge($folders, [(string) ($item['name'] ?? '')])));
        }
    }

    return $requests;
}

function adsPathAndParams(array $request): array
{
    $url = is_array($request['url'] ?? null) ? $request['url'] : [];
    $segments = is_array($url['path'] ?? null) ? $url['path'] : [];
    $pathParams = [];
    $pathParts = [];

    foreach ($segments as $segment) {
        $segment = (string) $segment;
        if ($segment === '{{version}}') {
            $pathParts[] = '{version}';
            continue;
        }

        if (preg_match('/^\{\{(.+)\}\}$/', $segment, $m)) {
            $pathParts[] = '{' . $m[1] . '}';
            if ($m[1] !== 'version') {
                $pathParams[] = $m[1];
            }
            continue;
        }

        $pathParts[] = $segment;
    }

    return ['/' . implode('/', $pathParts), $pathParams];
}

function generateXAdsPackage(string $root, array $collection): int
{
    $pkg = "{$root}/packages/x-ads";
    cleanDir($pkg);
    ensureDir("{$pkg}/src/Tools");
    ensureDir("{$pkg}/lua-docs");

    $requests = collectPostmanRequests($collection['item'] ?? []);
    $operations = [];
    $seenSlugs = [];
    $seenClasses = [];

    foreach ($requests as $item) {
        $request = $item['request'];
        $method = strtoupper((string) ($request['method'] ?? 'GET'));
        [$path, $pathParams] = adsPathAndParams($request);
        $pathNoVersion = preg_replace('#^\{version\}/?#', '', ltrim($path, '/')) ?? ltrim($path, '/');
        $baseSlug = 'x_ads_' . snake(strtolower($method) . '_' . $pathNoVersion);
        $slug = $baseSlug;
        for ($i = 2; isset($seenSlugs[$slug]); $i++) {
            $slug = $baseSlug . '_' . $i;
        }
        $seenSlugs[$slug] = true;

        $class = 'XAds' . studly(substr($slug, strlen('x_ads_')));
        for ($i = 2; isset($seenClasses[$class]); $i++) {
            $class = 'XAds' . studly(substr($slug, strlen('x_ads_'))) . $i;
        }
        $seenClasses[$class] = true;

        $parameters = [];
        $operationParameters = [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
        ];
        foreach ($pathParams as $param) {
            $parameters[$param] = [
                'type' => 'string',
                'required' => true,
                'description' => humanize($param) . ' path parameter.',
            ];
            $operationParameters[] = [
                'name' => $param,
                'in' => 'path',
                'required' => true,
                'style' => null,
                'explode' => null,
            ];
        }

        foreach (($request['url']['query'] ?? []) as $query) {
            if (!is_array($query) || !isset($query['key'])) {
                continue;
            }
            $key = (string) $query['key'];
            $description = strtolower((string) ($query['description'] ?? ''));
            $required = str_contains($description, 'required') && !str_contains($description, 'optional');
            $parameters[$key] = [
                'type' => 'string',
                'required' => $required,
                'description' => trim((string) ($query['description'] ?? 'Query parameter.')) ?: 'Query parameter.',
            ];
            $operationParameters[] = [
                'name' => $key,
                'in' => 'query',
                'required' => $required,
                'style' => null,
                'explode' => null,
            ];
        }

        $bodyMode = 'form';
        if (isset($request['body']) && is_array($request['body'])) {
            $bodyMode = (string) ($request['body']['mode'] ?? 'form');
            $parameters['body'] = [
                'type' => 'object',
                'required' => in_array($method, ['POST', 'PUT', 'PATCH'], true),
                'description' => 'Request body or form fields for this X Ads API operation.',
            ];
        }

        $folder = implode(' / ', array_filter($item['_folders'] ?? [], 'strlen'));
        $displayName = humanize($method . ' ' . ($item['name'] ?? $pathNoVersion));
        $description = trim($folder . ' ' . (string) ($item['name'] ?? $pathNoVersion));
        $runtimeMode = str_contains($slug, 'stats_jobs') ? 'async_job' : 'request_response';

        $operations[] = [
            'slug' => $slug,
            'class' => $class,
            'operation_id' => substr($slug, strlen('x_ads_')),
            'name' => $displayName,
            'description' => 'X Ads API operation: ' . $description . '.',
            'parameters' => $parameters,
            'type' => writeType($method, $slug),
            'auth_modes' => ['oauth1a_user_context'],
            'required_scopes' => ['ads_api_access'],
            'required_access_tier' => 'approved_ads_api_access',
            'runtime_mode' => $runtimeMode,
            'destructive' => destructive($method, $slug),
            'billing_sensitive' => $method !== 'GET' || str_contains($slug, 'campaign') || str_contains($slug, 'line_item') || str_contains($slug, 'funding'),
            'docs_url' => 'https://docs.x.com/x-ads-api',
            'operation' => [
                'id' => substr($slug, strlen('x_ads_')),
                'method' => $method,
                'path' => $path,
                'parameters' => $operationParameters,
                'has_body' => isset($parameters['body']),
                'body_mode' => $bodyMode === 'raw' ? 'json' : 'form',
                'auth_modes' => ['oauth1a_user_context'],
                'required_scopes' => ['ads_api_access'],
                'runtime_mode' => $runtimeMode,
                'tags' => array_values(array_filter($item['_folders'] ?? [], 'strlen')),
            ],
        ];
    }

    foreach ($operations as $operation) {
        writeFileChecked(
            "{$pkg}/src/Tools/{$operation['class']}.php",
            generatedToolClass('OpenCompany\\Integrations\\XAds', 'XAdsGeneratedTool', $operation),
        );
    }

    writeFileChecked("{$pkg}/src/Tools/XAdsGeneratedTool.php", <<<'PHP'
<?php

namespace OpenCompany\Integrations\XAds\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\XAds\XAdsService;

/**
 * Base class for generated X Ads API operation tools.
 *
 * Each concrete tool contains operation metadata derived from the official X
 * Ads Postman collection and delegates signed requests to the service.
 */
abstract class XAdsGeneratedTool implements Tool
{
    protected const SLUG = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const OPERATION = [];

    /**
     * @param  XAdsService  $service  The X Ads API client
     */
    public function __construct(
        protected XAdsService $service,
    ) {}

    public function name(): string
    {
        return static::SLUG;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the generated X Ads API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        foreach (static::PARAMETERS as $key => $schema) {
            if (($schema['required'] ?? false) && (!array_key_exists($key, $args) || $args[$key] === '' || $args[$key] === null)) {
                return ToolResult::error("{$key} is required.");
            }
        }

        try {
            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
PHP);

    writeFileChecked("{$pkg}/src/XAdsService.php", <<<'PHP'
<?php

namespace OpenCompany\Integrations\XAds;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use OpenCompany\IntegrationCore\Support\OAuth1Signer;

/**
 * HTTP client for the X Ads API.
 *
 * Signs every request with OAuth 1.0a user-context credentials and executes
 * generated operation metadata from the official X Ads Postman collection.
 */
class XAdsService
{
    public function __construct(
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $accessToken = '',
        private string $accessTokenSecret = '',
        private string $accountId = '',
        private string $apiVersion = '11',
        private string $baseUrl = 'https://ads-api.x.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether OAuth 1.0a credentials are configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== ''
            && $this->apiSecret !== ''
            && $this->accessToken !== ''
            && $this->accessTokenSecret !== '';
    }

    /**
     * Execute one generated X Ads API operation.
     *
     * @param  array<string, mixed>  $operation  Generated operation metadata
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>|string
     */
    public function executeOperation(array $operation, array $args): array|string
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('X Ads OAuth 1.0a credentials are not configured.');
        }

        [$url, $query, $body] = $this->prepareRequest($operation, $args);
        $method = strtoupper((string) ($operation['method'] ?? 'GET'));
        $bodyMode = (string) ($operation['body_mode'] ?? 'form');

        $headers = [
            'Authorization' => OAuth1Signer::authorizationHeader(
                method: $method,
                url: $url,
                queryParams: $query,
                bodyParams: $bodyMode === 'form' ? $body : [],
                consumerKey: $this->apiKey,
                consumerSecret: $this->apiSecret,
                token: $this->accessToken,
                tokenSecret: $this->accessTokenSecret,
            ),
        ];

        $http = Http::withHeaders($headers)->acceptJson()->timeout(30);
        $http = $bodyMode === 'form' ? $http->asForm() : $http->asJson();

        $response = match ($method) {
            'GET' => $http->get($url, $query),
            'POST' => $http->post($this->urlWithQuery($url, $query), $body),
            'PUT' => $http->put($this->urlWithQuery($url, $query), $body),
            'PATCH' => $http->patch($this->urlWithQuery($url, $query), $body),
            'DELETE' => $http->delete($this->urlWithQuery($url, $query), $body),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };

        if (!$response->successful()) {
            $json = $response->json();
            $error = is_array($json)
                ? ($json['errors'][0]['message'] ?? $json['error'] ?? json_encode($json))
                : $response->body();

            Log::error('X Ads API error', [
                'status' => $response->status(),
                'operation' => $operation['id'] ?? null,
                'error' => $error,
            ]);

            throw new \RuntimeException('X Ads API error (' . $response->status() . '): ' . (string) $error);
        }

        $json = $response->json();

        return is_array($json) ? $json : $response->body();
    }

    /**
     * Test credentials by listing accessible ad accounts.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'error' => 'X Ads OAuth 1.0a credentials are not configured.'];
        }

        try {
            $result = $this->executeOperation([
                'id' => 'get_accounts',
                'method' => 'GET',
                'path' => '/{version}/accounts',
                'parameters' => [['name' => 'version', 'in' => 'path', 'required' => false]],
                'body_mode' => 'form',
                'runtime_mode' => 'request_response',
            ], []);

            $count = is_array($result) && isset($result['data']) && is_array($result['data']) ? count($result['data']) : 0;

            return ['success' => true, 'message' => "Connected to X Ads. Accessible ad accounts: {$count}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @param  array<string, mixed>  $operation
     * @param  array<string, mixed>  $args
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>}
     */
    private function prepareRequest(array $operation, array $args): array
    {
        $path = (string) ($operation['path'] ?? '/');
        $query = [];
        $body = isset($args['body']) && is_array($args['body']) ? $args['body'] : [];

        foreach ($operation['parameters'] ?? [] as $parameter) {
            if (!is_array($parameter)) {
                continue;
            }

            $name = (string) ($parameter['name'] ?? '');
            if ($name === '') {
                continue;
            }

            $value = $args[$name] ?? null;
            if ($name === 'version') {
                $value = $value ?: $this->apiVersion;
            } elseif ($name === 'account_id' && ($value === null || $value === '') && $this->accountId !== '') {
                $value = $this->accountId;
            }

            if ($value === null || $value === '') {
                continue;
            }

            if (($parameter['in'] ?? '') === 'path') {
                $path = str_replace('{' . $name . '}', rawurlencode((string) $value), $path);
                continue;
            }

            if (($parameter['in'] ?? '') === 'query') {
                $query[$name] = is_array($value) ? implode(',', array_map('strval', $value)) : $value;
            }
        }

        return [$this->baseUrl . '/' . ltrim($path, '/'), $query, $body];
    }

    /**
     * @param  array<string, mixed>  $query
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if (empty($query)) {
            return $url;
        }

        return $url . (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
    }
}
PHP);

    $providerTools = exportArray(buildProviderTools($operations, 'OpenCompany\\Integrations\\XAds', 'simple-icons:x'), 8);
    $operationCount = count($operations);

    writeFileChecked("{$pkg}/src/XAdsServiceProvider.php", <<<'PHP'
<?php

namespace OpenCompany\Integrations\XAds;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the generated X Ads integration.
 *
 * Binds the OAuth 1.0a signed Ads API service and registers the generated
 * tools with the host registry when available.
 */
class XAdsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XAdsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XAdsService(
                apiKey: $creds->get('x_ads', 'api_key', ''),
                apiSecret: $creds->get('x_ads', 'api_secret', ''),
                accessToken: $creds->get('x_ads', 'access_token', ''),
                accessTokenSecret: $creds->get('x_ads', 'access_token_secret', ''),
                accountId: $creds->get('x_ads', 'account_id', ''),
                apiVersion: $creds->get('x_ads', 'api_version', '11'),
                baseUrl: $creds->get('x_ads', 'base_url', 'https://ads-api.x.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XAdsToolProvider());
        }
    }
}
PHP);

    writeFileChecked("{$pkg}/src/XAdsToolProvider.php", <<<PHP
<?php

namespace OpenCompany\Integrations\XAds;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides generated X Ads API tools.
 *
 * Tool metadata is generated from the official X Developer Platform Postman
 * collection for the Ads API.
 */
class XAdsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'x_ads';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'X Ads',
            'description' => 'X advertising API',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'X Ads',
            'description' => 'Generated coverage of the X Ads API for ad accounts, campaigns, line items, creatives, targeting, audiences, analytics, and funding instruments.',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://docs.x.com/x-ads-api',
        ];
    }

    /**
     * Describe X Ads auth and host capability metadata.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth1a_user_context',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token', 'pin_oauth1'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key', 'api_secret', 'access_token', 'access_token_secret'],
                'source' => [
                    'type' => 'postman_collection',
                    'url' => 'https://github.com/xdevplatform/postman-twitter-ads-api',
                    'operation_count' => {$operationCount},
                ],
                'notes' => [
                    'X Ads API access requires approval from X.',
                    'All requests are signed with OAuth 1.0a user-context credentials.',
                    'CLI setup works with manually stored tokens or PIN-based OAuth 1.0a.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_oauth1',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_pin_oauth1',
                    'runtime_mode' => 'normal',
                ],
                'mcp_gateway' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'kosmokrator_gateway',
                    'runtime_mode' => 'request_response_tools',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
                'mcp_gateway_supported' => true,
                'lua_supported' => true,
            ],
            'seo' => [
                'aliases' => ['twitter ads', 'x ads api', 'ads-api.x.com', 'campaign management'],
            ],
        ];
    }

    public function configSchema(): array
    {
        return \$this->credentialFields();
    }

    /**
     * Validate X Ads credentials with a lightweight account listing request.
     *
     * @param  array<string, mixed>  \$config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array \$config): array
    {
        \$service = new XAdsService(
            apiKey: (string) (\$config['api_key'] ?? ''),
            apiSecret: (string) (\$config['api_secret'] ?? ''),
            accessToken: (string) (\$config['access_token'] ?? ''),
            accessTokenSecret: (string) (\$config['access_token_secret'] ?? ''),
            accountId: (string) (\$config['account_id'] ?? ''),
            apiVersion: (string) (\$config['api_version'] ?? '11'),
            baseUrl: (string) (\$config['base_url'] ?? 'https://ads-api.x.com'),
        );

        return \$service->testConnection();
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'api_secret' => 'required|string',
            'access_token' => 'required|string',
            'access_token_secret' => 'required|string',
            'account_id' => 'nullable|string',
            'api_version' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return {$providerTools};
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/x-ads.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'API Secret', 'required' => true],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'access_token_secret', 'type' => 'secret', 'label' => 'Access Token Secret', 'required' => true],
            ['key' => 'account_id', 'type' => 'string', 'label' => 'Default Ads Account ID', 'required' => false],
            ['key' => 'api_version', 'type' => 'string', 'label' => 'Ads API Version', 'required' => false, 'default' => '11'],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://ads-api.x.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a generated X Ads tool with optional multi-account credentials.
     *
     * @param  class-string<Tool>  \$class  Tool class name
     * @param  array<string, mixed>  \$context  Runtime context
     */
    public function createTool(string \$class, array \$context = []): Tool
    {
        return new \$class(\$this->resolveService(\$context));
    }

    /**
     * Resolve the service for the default or named account.
     *
     * @param  array<string, mixed>  \$context
     */
    private function resolveService(array \$context = []): XAdsService
    {
        \$account = \$context['account'] ?? null;

        if (\$account !== null) {
            \$creds = app(CredentialResolver::class);

            return new XAdsService(
                apiKey: \$creds->get('x_ads', 'api_key', '', \$account),
                apiSecret: \$creds->get('x_ads', 'api_secret', '', \$account),
                accessToken: \$creds->get('x_ads', 'access_token', '', \$account),
                accessTokenSecret: \$creds->get('x_ads', 'access_token_secret', '', \$account),
                accountId: \$creds->get('x_ads', 'account_id', '', \$account),
                apiVersion: \$creds->get('x_ads', 'api_version', '11', \$account),
                baseUrl: \$creds->get('x_ads', 'base_url', 'https://ads-api.x.com', \$account),
            );
        }

        return app(XAdsService::class);
    }
}
PHP);

    writeFileChecked("{$pkg}/composer.json", <<<'JSON'
{
    "name": "opencompanyapp/integration-x-ads",
    "description": "X Ads API integration for Laravel — generated coverage of X advertising account and campaign operations.",
    "license": "MIT",
    "authors": [
        {
            "name": "OpenCompany",
            "homepage": "https://github.com/OpenCompanyApp"
        }
    ],
    "keywords": ["tools", "x", "twitter", "ads", "marketing", "campaigns", "opencompany"],
    "require": {
        "php": "^8.2",
        "opencompanyapp/integration-core": "^2.0 || @dev"
    },
    "autoload": {
        "psr-4": {
            "OpenCompany\\Integrations\\XAds\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "OpenCompany\\Integrations\\XAds\\XAdsServiceProvider"
            ]
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
JSON);

    writeFileChecked("{$pkg}/README.md", <<<MD
# X Ads Integration

Generated integration for the X Ads API. It covers {$operationCount} operations from the official X Developer Platform Postman collection.

Use this package for advertiser workflows: ad accounts, funding instruments, campaigns, line items, creatives, targeting, audiences, analytics jobs, and billing-sensitive campaign operations.

## Authentication

X Ads API requests use OAuth 1.0a user-context signing. Configure:

- `api_key`
- `api_secret`
- `access_token`
- `access_token_secret`
- optional `account_id`
- optional `api_version` (default `11`)
- optional `base_url` (default `https://ads-api.x.com`)
MD);

    writeFileChecked("{$pkg}/lua-docs/x-ads.md", <<<MD
# X Ads — Lua API Reference

This integration is generated from the official X Ads Postman collection and exposes {$operationCount} Ads API operations.

## Authentication

Configure OAuth 1.0a user-context credentials:

- `api_key`
- `api_secret`
- `access_token`
- `access_token_secret`

X Ads API access must be approved by X. Tools are marked with `required_access_tier=approved_ads_api_access`.

## Runtime Notes

- Campaign, line item, creative, funding, and audience writes are marked `billing_sensitive`.
- Stats job endpoints are marked `runtime_mode=async_job`.
- If `account_id` is configured, tools with an `account_id` path parameter can omit it.

## Examples

```lua
local accounts = app.integrations.x_ads.x_ads_get_accounts({})
local campaigns = app.integrations.x_ads.x_ads_get_accounts_account_id_campaigns({
  account_id = "account-id",
  count = "25"
})
```
MD);

    writeFileChecked("{$pkg}/phpstan.neon", "parameters:\n    level: 5\n    paths:\n        - src\n");
    copy("{$root}/packages/x/LICENSE", "{$pkg}/LICENSE");

    return count($operations);
}

$xCount = generateXPackage($root, getJson(X_OPENAPI_URL));
$xAdsCount = generateXAdsPackage($root, getJson(X_ADS_POSTMAN_URL));

echo "Generated X operations: {$xCount}\n";
echo "Generated X Ads operations: {$xAdsCount}\n";

<?php

namespace OpenCompany\Integrations\Braintree;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the official Braintree GraphQL API.
 *
 * Handles Basic API-key or OAuth bearer authentication, GraphQL document generation, and response parsing for generated tools.
 */
class BraintreeService
{
    private const SANDBOX_URL = 'https://payments.sandbox.braintree-api.com/graphql';

    /**
     * @param  string  $accessToken  Optional OAuth bearer token for third-party integrations.
     * @param  string  $merchantId  Optional Braintree merchant ID for host metadata and legacy compatibility.
     * @param  string  $baseUrl  Braintree GraphQL endpoint.
     * @param  string  $publicKey  Braintree public API key for Basic auth.
     * @param  string  $privateKey  Braintree private API key for Basic auth.
     * @param  string  $version  Braintree-Version header in YYYY-MM-DD format.
     */
    public function __construct(
        private string $accessToken = '',
        private string $merchantId = '',
        private string $baseUrl = self::SANDBOX_URL,
        private string $publicKey = '',
        private string $privateKey = '',
        private string $version = '2019-01-01',
    ) {
        $this->baseUrl = rtrim($this->baseUrl !== '' ? $this->baseUrl : self::SANDBOX_URL, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || ($this->publicKey !== '' && $this->privateKey !== '');
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * Return all official Braintree GraphQL operation fields exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return BraintreeOperations::all();
    }

    /**
     * Return one operation definition by slug.
     *
     * @return array<string, mixed>
     */
    public function operation(string $operation): array
    {
        foreach (self::operations() as $definition) {
            if ($definition['slug'] === $operation) {
                return $definition;
            }
        }
        throw new RuntimeException("Unsupported Braintree operation: {$operation}");
    }

    /**
     * Execute an official GraphQL operation field using normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$query, $variables] = $this->buildDocument($definition, $args);
        return $this->graphql($query, $variables);
    }

    /**
     * Run a GraphQL document against Braintree.
     *
     * @param  array<string, mixed>  $variables  GraphQL variables.
     * @return array<string, mixed>
     */
    public function graphql(string $query, array $variables = []): array
    {
        $response = $this->rawGraphql($query, $variables);
        $json = $response->json() ?? [];
        if (isset($json['errors']) && is_array($json['errors']) && $json['errors'] !== []) {
            Log::error('Braintree GraphQL errors', ['errors' => $json['errors']]);
            throw new RuntimeException('Braintree GraphQL error: '.json_encode($json['errors']));
        }
        return $json;
    }

    /**
     * Build a GraphQL document and variable map for an operation definition.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: array<string, mixed>}
     */
    private function buildDocument(array $definition, array $args): array
    {
        $variables = [];
        $declarations = [];
        $fieldArgs = [];
        foreach ($definition['parameters'] as $parameter) {
            $param = (string) $parameter['param'];
            $name = (string) $parameter['name'];
            $required = (bool) ($parameter['required'] ?? false);
            if (!array_key_exists($param, $args)) {
                if ($required) {
                    throw new RuntimeException("{$param} is required for {$definition['slug']}.");
                }
                continue;
            }
            $variables[$name] = $args[$param];
            $declarations[] = '$'.$name.': '.$parameter['graphql_type'];
            $fieldArgs[] = $name.': $'.$name;
        }
        if (isset($args['variables']) && is_array($args['variables'])) {
            foreach ($args['variables'] as $name => $value) {
                $variables[(string) $name] = $value;
            }
        }
        $selection = trim((string) ($args['selection'] ?? ''));
        if ($selection === '' && !($definition['returns_scalar'] ?? false)) {
            $selection = '__typename';
        }
        $fieldCall = (string) $definition['field'].($fieldArgs === [] ? '' : '('.implode(', ', $fieldArgs).')');
        if (!($definition['returns_scalar'] ?? false)) {
            $fieldCall .= ' { '.$selection.' }';
        }
        $body = match ($definition['scope']) {
            'search' => 'search { '.$fieldCall.' }',
            'report' => 'report { '.$fieldCall.' }',
            default => $fieldCall,
        };
        $operationName = str_replace(' ', '', ucwords(str_replace('_', ' ', (string) $definition['operation'])));
        $declarationText = $declarations === [] ? '' : '('.implode(', ', $declarations).')';
        $query = $definition['graphql_kind'].' Braintree'.$operationName.$declarationText.' { '.$body.' }';
        return [$query, $variables];
    }

    /**
     * Execute a raw GraphQL HTTP request.
     *
     * @param  array<string, mixed>  $variables  GraphQL variables.
     */
    private function rawGraphql(string $query, array $variables = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Braintree credentials are not configured. Provide public/private keys or an OAuth access token.');
        }
        $headers = ['Accept' => 'application/json', 'Content-Type' => 'application/json', 'Braintree-Version' => $this->version ?: '2019-01-01'];
        $headers['Authorization'] = $this->publicKey !== '' && $this->privateKey !== ''
            ? 'Basic '.base64_encode($this->publicKey.':'.$this->privateKey)
            : 'Bearer '.$this->accessToken;
        try {
            $response = Http::withHeaders($headers)->timeout(30)->post($this->baseUrl, ['query' => $query, 'variables' => $variables]);
            if (!$response->successful()) {
                Log::error('Braintree GraphQL HTTP error', ['status' => $response->status(), 'body' => $response->body()]);
                throw new RuntimeException("Braintree GraphQL HTTP error ({$response->status()}): {$response->body()}");
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Braintree GraphQL connection error', ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Braintree GraphQL API: {$e->getMessage()}");
        }
    }
}
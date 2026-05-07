<?php

namespace OpenCompany\Integrations\HaveIBeenPwned;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Have I Been Pwned API.
 *
 * Handles required user-agent headers, optional API-key authentication, v3
 * endpoint routing, Pwned Passwords range parsing, and error normalization.
 */
class HaveIBeenPwnedService
{
    private const USER_AGENT = 'OpenCompany Integrations (https://opencompany.ai)';

    /**
     * @param  string  $apiKey  Optional HIBP API key for protected endpoints.
     * @param  string  $baseUrl  HIBP API v3 base URL.
     * @param  string  $passwordsBaseUrl  Pwned Passwords API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://haveibeenpwned.com/api/v3',
        private string $passwordsBaseUrl = 'https://api.pwnedpasswords.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->passwordsBaseUrl = rtrim($this->passwordsBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    public function hasApiKey(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Return breaches for an email address.
     *
     * @param  array<string, mixed>  $params  Query filters: truncate_response, domain, include_unverified.
     * @return array<string, mixed>|list<mixed>
     */
    public function breachedAccount(string $account, array $params = []): array
    {
        return $this->request('GET', '/breachedAccount/'.$this->encodePath($account), $this->accountQuery($params), [], true, true);
    }

    /**
     * Return breached-account hash suffixes for a six-character SHA-1 prefix.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function breachedAccountRange(string $prefix): array
    {
        $prefix = strtoupper(trim($prefix));
        if (!preg_match('/^[A-F0-9]{6}$/', $prefix)) {
            throw new RuntimeException('prefix must be exactly 6 hexadecimal SHA-1 characters.');
        }

        return $this->request('GET', '/breachedAccount/range/'.$prefix, [], [], true);
    }

    /**
     * List public breach catalogue entries.
     *
     * @param  array<string, mixed>  $params  Query filters: domain, is_spam_list.
     * @return array<string, mixed>|list<mixed>
     */
    public function breaches(array $params = []): array
    {
        $query = [];
        if (($params['domain'] ?? '') !== '') {
            $query['Domain'] = (string) $params['domain'];
        }
        if (array_key_exists('is_spam_list', $params)) {
            $query['IsSpamList'] = $this->boolString((bool) $params['is_spam_list']);
        }

        return $this->request('GET', '/breaches', $query);
    }

    /**
     * Retrieve one public breach by stable breach name.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function breachByName(string $name): array
    {
        return $this->request('GET', '/breach/'.$this->encodePath($name));
    }

    /**
     * Retrieve the most recently added breach.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function latestBreach(): array
    {
        return $this->request('GET', '/latestBreach');
    }

    /**
     * List all public breach data classes.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function dataClasses(): array
    {
        return $this->request('GET', '/dataClasses');
    }

    /**
     * List paste records for an email address.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function pasteAccount(string $account): array
    {
        return $this->request('GET', '/pasteAccount/'.$this->encodePath($account), [], [], true, true);
    }

    /**
     * List breached email aliases for a verified domain.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function breachedDomain(string $domain): array
    {
        return $this->request('GET', '/breachedDomain/'.$this->encodePath($domain), [], [], true, true);
    }

    /**
     * List domains associated with the API-key subscription.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function subscribedDomains(): array
    {
        return $this->request('GET', '/subscribedDomains', [], [], true);
    }

    /**
     * Generate a DNS TXT verification token for a domain.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function generateDnsToken(string $domain): array
    {
        return $this->request('POST', '/domainVerification/generateDnsToken', [], ['DomainName' => $domain], true);
    }

    /**
     * Verify that a domain has the generated HIBP DNS TXT token.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function verifyDnsToken(string $domain): array
    {
        return $this->request('POST', '/domainVerification/verifyDnsToken', [], ['DomainName' => $domain], true);
    }

    /**
     * Send a domain verification email to an allowed alias.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function sendDomainVerificationEmail(string $domain, string $emailAlias): array
    {
        $emailAlias = strtolower(trim($emailAlias));
        $allowed = ['admin', 'hostmaster', 'info', 'security', 'webmaster'];
        if (!in_array($emailAlias, $allowed, true)) {
            throw new RuntimeException('email_alias must be one of: '.implode(', ', $allowed).'.');
        }

        return $this->request('POST', '/domainVerification/sendEmail', [], ['DomainName' => $domain, 'EmailAlias' => $emailAlias], true);
    }

    /**
     * List stealer-log website domains seen for an email address.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function stealerLogsByEmail(string $email): array
    {
        return $this->request('GET', '/stealerLogsByEmail/'.$this->encodePath($email), [], [], true, true);
    }

    /**
     * List stealer-log email addresses seen against a website domain.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function stealerLogsByWebsiteDomain(string $domain): array
    {
        return $this->request('GET', '/stealerLogsByWebsiteDomain/'.$this->encodePath($domain), [], [], true, true);
    }

    /**
     * List stealer-log email aliases and website domains for an email domain.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function stealerLogsByEmailDomain(string $domain): array
    {
        return $this->request('GET', '/stealerLogsByEmailDomain/'.$this->encodePath($domain), [], [], true, true);
    }

    /**
     * Retrieve subscription status for the configured API key.
     *
     * @return array<string, mixed>|list<mixed>
     */
    public function subscriptionStatus(): array
    {
        return $this->request('GET', '/subscription/status', [], [], true);
    }

    /**
     * Query Pwned Passwords by the first five SHA-1 or NTLM hash characters.
     *
     * @return array{prefix: string, mode: string, padded: bool, matches: list<array{hash_suffix: string, count: int}>}
     */
    public function pwnedPasswordRange(string $prefix, string $mode = 'sha1', bool $padding = true): array
    {
        $prefix = strtoupper(trim($prefix));
        if (!preg_match('/^[A-F0-9]{5}$/', $prefix)) {
            throw new RuntimeException('prefix must be exactly 5 hexadecimal hash characters.');
        }

        $mode = strtolower(trim($mode));
        if (!in_array($mode, ['sha1', 'ntlm'], true)) {
            throw new RuntimeException('mode must be sha1 or ntlm.');
        }

        try {
            $request = Http::timeout(60)
                ->withUserAgent(self::USER_AGENT)
                ->withHeaders($padding ? ['Add-Padding' => 'true'] : []);

            $query = $mode === 'ntlm' ? ['mode' => 'ntlm'] : [];
            $response = $request->get($this->passwordsBaseUrl.'/range/'.$prefix, $query);
            if (!$response->successful()) {
                $this->throwResponseError($response, '/range/'.$prefix);
            }

            return [
                'prefix' => $prefix,
                'mode' => $mode,
                'padded' => $padding,
                'matches' => $this->parsePasswordRange($response->body()),
            ];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Pwned Passwords API connection error', ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Pwned Passwords API: '.$e->getMessage());
        }
    }

    /**
     * Execute an HIBP API request.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     * @param  array<string, mixed>  $payload  JSON payload for POST requests.
     * @return array<string, mixed>|list<mixed>
     */
    private function request(string $method, string $path, array $query = [], array $payload = [], bool $requiresAuth = false, bool $emptyOn404 = false): array
    {
        if ($requiresAuth && !$this->hasApiKey()) {
            throw new RuntimeException('HIBP API key is required for this endpoint.');
        }

        try {
            $request = Http::acceptJson()
                ->asJson()
                ->withUserAgent(self::USER_AGENT)
                ->timeout(60);

            if ($this->hasApiKey()) {
                $request = $request->withHeaders(['hibp-api-key' => $this->apiKey]);
            }

            $response = strtoupper($method) === 'POST'
                ? $request->post($this->baseUrl.$path, $payload)
                : $request->get($this->baseUrl.$path, $this->cleanQuery($query));

            if ($emptyOn404 && $response->status() === 404) {
                return [];
            }

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Have I Been Pwned API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Have I Been Pwned API: '.$e->getMessage());
        }
    }

    /**
     * Build direct account-search query-string parameters.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array<string, mixed>
     */
    private function accountQuery(array $params): array
    {
        $query = [];
        if (array_key_exists('truncate_response', $params)) {
            $query['truncateResponse'] = $this->boolString((bool) $params['truncate_response']);
        }
        if (($params['domain'] ?? '') !== '') {
            $query['Domain'] = (string) $params['domain'];
        }
        if (array_key_exists('include_unverified', $params)) {
            $query['IncludeUnverified'] = $this->boolString((bool) $params['include_unverified']);
        }

        return $query;
    }

    /**
     * Remove null and empty query-string values.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     * @return array<string, mixed>
     */
    private function cleanQuery(array $query): array
    {
        return array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');
    }

    /**
     * Parse JSON responses and normalize HTTP errors.
     *
     * @return array<string, mixed>|list<mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        if (!$response->successful()) {
            $this->throwResponseError($response, $path);
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        if ($response->body() === '') {
            return ['status' => $response->status()];
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Convert HIBP error responses into runtime exceptions.
     */
    private function throwResponseError(Response $response, string $path): never
    {
        $json = $response->json();
        $message = null;
        if (is_array($json)) {
            $message = $json['message'] ?? $json['error'] ?? null;
        }
        $message = is_string($message) && $message !== '' ? $message : $response->body();
        Log::error('Have I Been Pwned API error: '.$path, ['status' => $response->status(), 'error' => $message]);

        throw new RuntimeException('Have I Been Pwned API error ('.$response->status().'): '.$message);
    }

    /**
     * Parse colon-delimited Pwned Passwords range response lines.
     *
     * @return list<array{hash_suffix: string, count: int}>
     */
    private function parsePasswordRange(string $body): array
    {
        $matches = [];
        foreach (preg_split('/\r\n|\r|\n/', trim($body)) ?: [] as $line) {
            if ($line === '' || !str_contains($line, ':')) {
                continue;
            }
            [$suffix, $count] = explode(':', $line, 2);
            $matches[] = ['hash_suffix' => strtoupper($suffix), 'count' => (int) $count];
        }

        return $matches;
    }

    private function encodePath(string $value): string
    {
        return rawurlencode(trim($value));
    }

    private function boolString(bool $value): string
    {
        return $value ? 'true' : 'false';
    }
}

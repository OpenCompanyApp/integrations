<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Agora Cloud Recording RESTful APIs.
 *
 * Handles Basic authentication with Agora customer credentials and exposes the
 * documented cloud recording session lifecycle endpoints.
 */
class AgoraService
{
    /**
     * @param  string  $customerId  Agora RESTful API customer ID.
     * @param  string  $customerSecret  Agora RESTful API customer secret.
     * @param  string  $appId  Agora project App ID with Cloud Recording enabled.
     * @param  string  $baseUrl  Agora REST API base URL.
     */
    public function __construct(
        private string $customerId = '',
        private string $customerSecret = '',
        private string $appId = '',
        private string $baseUrl = 'https://api.sd-rtn.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether all credentials required for Cloud Recording are set.
     */
    public function isConfigured(): bool
    {
        return $this->customerId !== '' && $this->customerSecret !== '' && $this->appId !== '';
    }

    /**
     * Request a resource ID for one Cloud Recording session.
     *
     * @param  string  $cname  Channel name to record.
     * @param  string  $uid  Recording client UID. Must be unique in the channel.
     * @param  array<string, mixed>  $clientRequest  Agora acquire clientRequest body.
     * @return array<string, mixed>
     */
    public function acquireResource(string $cname, string $uid, array $clientRequest = []): array
    {
        return $this->request('POST', $this->recordingPath('/acquire'), [
            'cname' => $cname,
            'uid' => $uid,
            'clientRequest' => $clientRequest,
        ]);
    }

    /**
     * Start a Cloud Recording session with a previously acquired resource ID.
     *
     * @param  string  $resourceId  Resource ID returned by acquire.
     * @param  string  $mode  Recording mode: individual, mix, or web.
     * @param  string  $cname  Channel name to record.
     * @param  string  $uid  Recording client UID used in acquire.
     * @param  array<string, mixed>  $clientRequest  Agora start clientRequest body.
     * @return array<string, mixed>
     */
    public function startRecording(string $resourceId, string $mode, string $cname, string $uid, array $clientRequest): array
    {
        return $this->request('POST', $this->recordingSessionPath($resourceId, null, $mode, '/start'), [
            'cname' => $cname,
            'uid' => $uid,
            'clientRequest' => $clientRequest,
        ]);
    }

    /**
     * Query the current status of an active Cloud Recording session.
     *
     * @param  string  $resourceId  Resource ID returned by acquire.
     * @param  string  $sid  Recording session ID returned by start.
     * @param  string  $mode  Recording mode: individual, mix, or web.
     * @return array<string, mixed>
     */
    public function queryRecording(string $resourceId, string $sid, string $mode): array
    {
        return $this->request('GET', $this->recordingSessionPath($resourceId, $sid, $mode, '/query'));
    }

    /**
     * Update an active recording session's subscription or web recording state.
     *
     * @param  string  $resourceId  Resource ID returned by acquire.
     * @param  string  $sid  Recording session ID returned by start.
     * @param  string  $mode  Recording mode: individual, mix, or web.
     * @param  string  $cname  Channel name used for the recording.
     * @param  string  $uid  Recording client UID used in acquire and start.
     * @param  array<string, mixed>  $clientRequest  Agora update clientRequest body.
     * @return array<string, mixed>
     */
    public function updateRecording(string $resourceId, string $sid, string $mode, string $cname, string $uid, array $clientRequest): array
    {
        return $this->request('POST', $this->recordingSessionPath($resourceId, $sid, $mode, '/update'), [
            'cname' => $cname,
            'uid' => $uid,
            'clientRequest' => $clientRequest,
        ]);
    }

    /**
     * Update the video mixing layout for an active composite recording.
     *
     * @param  string  $resourceId  Resource ID returned by acquire.
     * @param  string  $sid  Recording session ID returned by start.
     * @param  string  $cname  Channel name used for the recording.
     * @param  string  $uid  Recording client UID used in acquire and start.
     * @param  array<string, mixed>  $clientRequest  Agora updateLayout clientRequest body.
     * @return array<string, mixed>
     */
    public function updateLayout(string $resourceId, string $sid, string $cname, string $uid, array $clientRequest): array
    {
        return $this->request('POST', $this->recordingSessionPath($resourceId, $sid, 'mix', '/updateLayout'), [
            'cname' => $cname,
            'uid' => $uid,
            'clientRequest' => $clientRequest,
        ]);
    }

    /**
     * Stop an active Cloud Recording session.
     *
     * @param  string  $resourceId  Resource ID returned by acquire.
     * @param  string  $sid  Recording session ID returned by start.
     * @param  string  $mode  Recording mode: individual, mix, or web.
     * @param  string  $cname  Channel name used for the recording.
     * @param  string  $uid  Recording client UID used in acquire and start.
     * @param  array<string, mixed>  $clientRequest  Agora stop clientRequest body.
     * @return array<string, mixed>
     */
    public function stopRecording(string $resourceId, string $sid, string $mode, string $cname, string $uid, array $clientRequest = []): array
    {
        return $this->request('POST', $this->recordingSessionPath($resourceId, $sid, $mode, '/stop'), [
            'cname' => $cname,
            'uid' => $uid,
            'clientRequest' => $clientRequest,
        ]);
    }

    /**
     * Query notification service IP addresses for firewall allowlists.
     *
     * @return array<string, mixed>
     */
    public function getNotificationIps(): array
    {
        return $this->request('GET', '/v1/ncs/ip', [], false);
    }

    /**
     * Make an authenticated Agora request and parse the JSON response.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @param  bool  $requiresAppId  Whether this endpoint requires configured app_id.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $requiresAppId = true): array
    {
        $response = $this->rawRequest($method, $path, $data, $requiresAppId);

        return $response->json() ?? [];
    }

    /**
     * Make a raw authenticated HTTP request to Agora.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @param  bool  $requiresAppId  Whether this endpoint requires configured app_id.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $requiresAppId = true): Response
    {
        if ($this->customerId === '' || $this->customerSecret === '') {
            throw new RuntimeException('Agora customer ID and customer secret are not configured.');
        }

        if ($requiresAppId && $this->appId === '') {
            throw new RuntimeException('Agora app ID is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->customerId, $this->customerSecret)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message')
                    ?? $response->json('error')
                    ?? $response->json('reason')
                    ?? $response->body();

                Log::error("Agora API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Agora API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Agora API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Agora API: {$e->getMessage()}");
        }
    }

    /**
     * Build a Cloud Recording endpoint path under the configured app ID.
     */
    private function recordingPath(string $suffix): string
    {
        return '/v1/apps/' . rawurlencode($this->appId) . '/cloud_recording' . $suffix;
    }

    /**
     * Build a Cloud Recording session endpoint path.
     */
    private function recordingSessionPath(string $resourceId, ?string $sid, string $mode, string $suffix): string
    {
        $path = '/resourceid/' . rawurlencode($resourceId);

        if ($sid !== null) {
            $path .= '/sid/' . rawurlencode($sid);
        }

        $path .= '/mode/' . rawurlencode($this->normalizeMode($mode)) . $suffix;

        return $this->recordingPath($path);
    }

    /**
     * Normalize agent-facing mode aliases to Agora path values.
     */
    private function normalizeMode(string $mode): string
    {
        return match (strtolower($mode)) {
            'individual' => 'individual',
            'mix', 'composite' => 'mix',
            'web', 'webpage', 'web_page' => 'web',
            default => $mode,
        };
    }
}

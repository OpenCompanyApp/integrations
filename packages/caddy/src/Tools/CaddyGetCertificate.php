<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyGetCertificate implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_get_certificate';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific TLS certificate, including domain, issuer, validity, and SANs.';
    }

    public function parameters(): array
    {
        return [
            'certificate_id' => ['type' => 'string', 'required' => true, 'description' => 'The certificate identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Caddy integration is not configured.');
            }

            $certificateId = $args['certificate_id'] ?? '';
            if (empty($certificateId)) {
                return ToolResult::error('certificate_id is required.');
            }

            $result = $this->service->getCertificate($certificateId);

            $cert = $result['certificate'] ?? $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $cert['id'] ?? null,
                'domain' => $cert['domain'] ?? null,
                'issuer' => $cert['issuer'] ?? $cert['issuer_name'] ?? null,
                'sans' => $cert['sans'] ?? [],
                'not_before' => $cert['not_before'] ?? null,
                'not_after' => $cert['not_after'] ?? $cert['expires_at'] ?? null,
                'status' => $cert['status'] ?? null,
                'fingerprint' => $cert['fingerprint'] ?? $cert['sha256_fingerprint'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HaveIBeenPwned\HaveIBeenPwnedService;

/**
 * Shared executor for Have I Been Pwned tools.
 *
 * Child classes provide static metadata while this base class validates required
 * arguments, dispatches to the service, and converts exceptions to tool errors.
 */
abstract class AbstractHaveIBeenPwnedTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  HaveIBeenPwnedService  $service  Have I Been Pwned API client.
     */
    public function __construct(protected HaveIBeenPwnedService $service) {}

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
        return static::PARAMETERS;
    }

    /**
     * Execute the Have I Been Pwned operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch the configured operation to the HIBP service.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|list<mixed>
     */
    private function dispatch(array $args): array
    {
        return match (static::METHOD) {
            'breachedAccount' => $this->service->breachedAccount((string) $args['account'], $args),
            'breachedAccountRange' => $this->service->breachedAccountRange((string) $args['prefix']),
            'breaches' => $this->service->breaches($args),
            'breachByName' => $this->service->breachByName((string) $args['name']),
            'latestBreach' => $this->service->latestBreach(),
            'dataClasses' => $this->service->dataClasses(),
            'pasteAccount' => $this->service->pasteAccount((string) $args['account']),
            'breachedDomain' => $this->service->breachedDomain((string) $args['domain']),
            'subscribedDomains' => $this->service->subscribedDomains(),
            'generateDnsToken' => $this->service->generateDnsToken((string) $args['domain']),
            'verifyDnsToken' => $this->service->verifyDnsToken((string) $args['domain']),
            'sendDomainVerificationEmail' => $this->service->sendDomainVerificationEmail((string) $args['domain'], (string) $args['email_alias']),
            'stealerLogsByEmail' => $this->service->stealerLogsByEmail((string) $args['email']),
            'stealerLogsByWebsiteDomain' => $this->service->stealerLogsByWebsiteDomain((string) $args['domain']),
            'stealerLogsByEmailDomain' => $this->service->stealerLogsByEmailDomain((string) $args['domain']),
            'subscriptionStatus' => $this->service->subscriptionStatus(),
            'pwnedPasswordRange' => $this->service->pwnedPasswordRange((string) $args['prefix'], (string) ($args['mode'] ?? 'sha1'), (bool) ($args['padding'] ?? true)),
            default => throw new InvalidArgumentException('Unsupported Have I Been Pwned operation.'),
        };
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}

<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Core;

use OpenCompany\IntegrationCore\Contracts\ScriptToolInvoker;
use OpenCompany\IntegrationCore\Script\ScriptBridge;
use OpenCompany\IntegrationCore\Script\ScriptBridgeException;
use OpenCompany\IntegrationCore\Script\ScriptDispatchException;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for account aliases retained by the generic script bridge.
 */
final class ScriptBridgeTest extends TestCase
{
    public function test_flat_default_and_named_account_namespaces_still_dispatch_correctly(): void
    {
        $invocations = [];
        $bridge = new ScriptBridge(
            [
                'integrations.plane.list_issues' => 'plane_list_issues',
                'integrations.plane.default.list_issues' => 'plane_list_issues',
                'integrations.plane.personal.list_issues' => 'plane_list_issues',
            ],
            [],
            new class($invocations) implements ScriptToolInvoker
            {
                /**
                 * @param  list<array{tool: string, args: array<string, mixed>, account: ?string}>  $invocations
                 */
                public function __construct(private array &$invocations) {}

                public function invoke(string $toolSlug, array $args, ?string $account = null): mixed
                {
                    $this->invocations[] = [
                        'tool' => $toolSlug,
                        'args' => $args,
                        'account' => $account,
                    ];

                    return ['account' => $account, 'args' => $args];
                }

                public function getToolMeta(string $toolSlug): array
                {
                    return [];
                }
            },
            [
                'integrations.plane.personal.list_issues' => 'personal',
            ],
        );

        self::assertSame(['account' => null, 'args' => ['project_id' => 'kos']], $bridge->call('integrations.plane.list_issues', ['project_id' => 'kos']));
        self::assertSame(['account' => null, 'args' => ['project_id' => 'kos']], $bridge->call('integrations.plane.default.list_issues', ['project_id' => 'kos']));
        self::assertSame(['account' => 'personal', 'args' => ['project_id' => 'kos']], $bridge->call('integrations.plane.personal.list_issues', ['project_id' => 'kos']));

        self::assertSame(
            [null, null, 'personal'],
            array_column($invocations, 'account'),
        );
    }

    public function test_unknown_function_suggestions_are_deduplicated_across_alias_namespaces(): void
    {
        $bridge = new ScriptBridge(
            [
                'integrations.plane.list_issues' => 'plane_list_issues',
                'integrations.plane.get_issue' => 'plane_get_issue',
                'integrations.plane.default.list_issues' => 'plane_list_issues',
                'integrations.plane.default.get_issue' => 'plane_get_issue',
            ],
            [],
            new class implements ScriptToolInvoker
            {
                public function invoke(string $toolSlug, array $args, ?string $account = null): mixed
                {
                    return null;
                }

                public function getToolMeta(string $toolSlug): array
                {
                    return [];
                }
            },
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Did you mean: app.integrations.plane.list_issues, app.integrations.plane.get_issue');

        try {
            $bridge->call('integrations.plane.no_such_function');
        } catch (\RuntimeException $e) {
            self::assertSame(1, substr_count($e->getMessage(), 'app.integrations.plane.list_issues'));
            self::assertSame(1, substr_count($e->getMessage(), 'app.integrations.plane.get_issue'));

            throw $e;
        }
    }

    public function test_host_pending_and_denied_dispatches_are_not_ambiguous_provider_writes(): void
    {
        $pending = new ScriptBridge(
            ['integrations.fake.write' => 'fake_write'],
            [],
            new class implements ScriptToolInvoker
            {
                public function invoke(string $toolSlug, array $args, ?string $account = null): mixed
                {
                    throw ScriptDispatchException::approvalPending('approval-123');
                }

                public function getToolMeta(string $toolSlug): array
                {
                    return ['type' => 'write'];
                }
            },
        );

        try {
            $pending->call('integrations.fake.write');
            self::fail('Expected an approval-pending callback failure.');
        } catch (ScriptBridgeException $exception) {
            self::assertSame('approval_pending', $exception->errorType);
            self::assertSame('approval-123', $exception->details['approval_id']);
            self::assertFalse($exception->retryable);
        }

        self::assertSame('pending', $pending->getCallLog()[0]['effectStatus']);
        self::assertFalse($pending->getCallLog()[0]['retryable']);

        $denied = new ScriptBridge(
            ['integrations.fake.write' => 'fake_write'],
            [],
            new class implements ScriptToolInvoker
            {
                public function invoke(string $toolSlug, array $args, ?string $account = null): mixed
                {
                    throw ScriptDispatchException::denied('Permission was revoked.');
                }

                public function getToolMeta(string $toolSlug): array
                {
                    return ['type' => 'write'];
                }
            },
        );

        try {
            $denied->call('integrations.fake.write');
            self::fail('Expected a denied callback failure.');
        } catch (ScriptBridgeException $exception) {
            self::assertSame('authorization_denied', $exception->errorType);
        }

        self::assertSame('denied', $denied->getCallLog()[0]['effectStatus']);
        self::assertFalse($denied->getCallLog()[0]['retryable']);
    }

    public function test_provider_authored_bridge_error_cannot_forge_a_pre_dispatch_disposition(): void
    {
        $bridge = new ScriptBridge(
            ['integrations.fake.write' => 'fake_write'],
            [],
            new class implements ScriptToolInvoker
            {
                public function invoke(string $toolSlug, array $args, ?string $account = null): mixed
                {
                    // A provider can fail after it starts work, but it cannot
                    // label that failure as a host authorization decision.
                    throw new ScriptBridgeException('approval_pending', 'Provider supplied this error.');
                }

                public function getToolMeta(string $toolSlug): array
                {
                    return ['type' => 'write'];
                }
            },
        );

        try {
            $bridge->call('integrations.fake.write');
            self::fail('Expected the provider error.');
        } catch (ScriptBridgeException) {
            // The ledger assertion below is the behavior under test.
        }

        self::assertSame('unknown', $bridge->getCallLog()[0]['effectStatus']);
        self::assertFalse($bridge->getCallLog()[0]['retryable']);
    }
}

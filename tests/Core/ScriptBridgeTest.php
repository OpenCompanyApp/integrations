<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Core;

use OpenCompany\IntegrationCore\Contracts\ScriptToolInvoker;
use OpenCompany\IntegrationCore\Script\ScriptBridge;
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
}

<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Core;

use PHPUnit\Framework\TestCase;

/**
 * Exercises the source-owned Script catalog used by mruby documentation CI.
 *
 * This test deliberately invokes the exporter in a child process. It therefore
 * verifies package identity from this checkout rather than trusting a host's
 * installed integration mirror, and it never resolves credentials or calls a
 * provider API.
 */
final class MrubyCatalogConformanceTest extends TestCase
{
    /**
     * The complete provider inventory must remain source-addressable and must
     * not be silently limited just because it is much larger than a demo set.
     */
    public function test_source_catalog_contracts_are_valid_for_the_full_inventory(): void
    {
        $root = dirname(__DIR__, 2);
        $autoload = getenv('OPENCOMPANY_HOST_AUTOLOAD') ?: $root.'/scripts/ci/vendor/autoload.php';
        self::assertFileExists($autoload, 'Set OPENCOMPANY_HOST_AUTOLOAD to a host Composer autoloader.');

        $process = proc_open(
            [PHP_BINARY, $root.'/scripts/check-mruby-contracts.php', $autoload],
            [0 => ['file', '/dev/null', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
            $pipes,
            $root,
        );
        self::assertIsResource($process);

        $output = stream_get_contents($pipes[1]);
        $errors = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        self::assertSame(0, proc_close($process), $errors);

        /** @var array{source_packages: int, source_tools: int, published_function_paths: int, parameter_paths: int, account_qualified_paths: int} $summary */
        $summary = json_decode($output, true, 512, JSON_THROW_ON_ERROR);
        self::assertGreaterThan(500, $summary['source_packages']);
        self::assertGreaterThan(40_000, $summary['source_tools']);
        self::assertGreaterThan($summary['source_tools'], $summary['published_function_paths']);
        self::assertSame($summary['published_function_paths'], $summary['parameter_paths']);
        self::assertGreaterThan($summary['source_tools'], $summary['account_qualified_paths']);
    }
}

<?php

namespace OpenCompany\Integrations\PlantUml;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class PlantUmlService
{
    /**
     * Render PlantUML syntax to raw image bytes.
     */
    public function renderToBytes(string $syntax, string $format = 'png'): string
    {
        $dpi = $this->resolveDpi($syntax);
        $jar = $this->findJar();
        $java = $this->findJava();

        $command = [
            $java,
            '-Djava.awt.headless=true',
            '-DPLANTUML_LIMIT_SIZE=16384',
            '-jar', $jar,
            '-t' . $format,
            '-Sdpi=' . $dpi,
            '-pipe',
        ];

        $process = new Process($command);
        $process->setTimeout(30);
        $process->setInput($syntax);
        $process->setEnv($this->buildEnv($process));
        $process->run();

        if (! $process->isSuccessful()) {
            $error = $process->getErrorOutput() ?: $process->getOutput();
            throw new \RuntimeException('PlantUML rendering failed: ' . trim($error));
        }

        $output = $process->getOutput();
        if (empty($output)) {
            throw new \RuntimeException('PlantUML produced no output.');
        }

        return $output;
    }

    /**
     * Render PlantUML syntax to a PNG image on public disk.
     *
     * @return string Public URL path to the generated PNG
     */
    public function render(string $syntax, string $format = 'png'): string
    {
        $bytes = $this->renderToBytes($syntax, $format);

        Storage::disk('public')->makeDirectory('plantuml');

        $relativePath = 'plantuml/' . Str::uuid()->toString() . '.png';
        Storage::disk('public')->put($relativePath, $bytes);

        return '/storage/' . $relativePath;
    }

    private function buildEnv(Process $process): array
    {
        $env = $process->getEnv();
        $path = getenv('PATH') ?: '/usr/local/bin:/usr/bin:/bin';
        foreach (['/opt/homebrew/bin', '/usr/local/bin', dirname(PHP_BINARY)] as $dir) {
            if (is_dir($dir) && !str_contains($path, $dir)) {
                $path = $dir . ':' . $path;
            }
        }
        $env['PATH'] = $path;

        return $env;
    }

    /**
     * Determine DPI based on diagram complexity.
     * Small diagrams get higher resolution, large ones stay reasonable.
     */
    private function resolveDpi(string $syntax): int
    {
        $lines = count(array_filter(explode("\n", $syntax), fn ($l) => trim($l) !== ''));

        return match (true) {
            $lines <= 15 => 300,
            $lines <= 40 => 250,
            default => 200,
        };
    }

    /**
     * Find the plantuml.jar in common locations.
     */
    private function findJar(): string
    {
        $candidates = [
            dirname(__DIR__) . '/bin/plantuml.jar',
            base_path('vendor/opencompanyapp/integration-plantuml/bin/plantuml.jar'),
            '/usr/local/share/plantuml.jar',
        ];

        foreach ($candidates as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        throw new \RuntimeException('plantuml.jar not found. Install it in the package bin/ directory.');
    }

    /**
     * Find the java binary.
     */
    private function findJava(): string
    {
        $candidates = [
            '/opt/homebrew/bin/java',
            '/usr/local/bin/java',
            '/usr/bin/java',
        ];

        foreach ($candidates as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return 'java';
    }
}

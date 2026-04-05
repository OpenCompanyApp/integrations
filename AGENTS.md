# AGENTS.md

Guidance for building and maintaining integration packages in this monorepo.

## Codebase Overview

This is a PHP 8.2+ monorepo of Composer packages that expose tools for AI agents. Each package under `packages/` is an independent Composer package built on a shared `core/`.

- **Tool** — A single callable action. Implements `name()`, `description()`, `parameters()`, `execute()`.
- **ToolProvider** — Groups tools under an app name. Declares metadata and handles instantiation.
- **ToolProviderRegistry** — Singleton that collects all providers for discovery.
- **CredentialResolver** — Abstraction for API keys. The host binds its own implementation.
- **Service** — HTTP client class that encapsulates all API communication for an integration.

For the full architecture, see `README.md`. For a step-by-step walkthrough, see `inspiration/AGENT-GUIDE.md`.

## File Structure

```
packages/{name}/
  composer.json
  src/
    {Name}Service.php             # API client — tools never make HTTP calls directly
    {Name}ServiceProvider.php     # Laravel DI registration + ToolProviderRegistry boot
    {Name}ToolProvider.php        # Tool catalog + ConfigurableIntegration + multi-account
    Tools/
      {Name}{Action}.php          # One class per tool
  lua-docs/
    {name}.md                     # Supplementary docs for the AI agent
```

## PHPDoc Conventions

All PHP files must include PHPDoc comments. This is non-negotiable.

### Class-level docblocks

Every class gets a docblock before the `class` declaration. One or two sentences describing what the class does.

```php
/**
 * Create a new issue in a GitHub repository.
 *
 * Supports title, body, assignees, labels, and milestone assignment.
 */
class GitHubCreateIssue implements Tool
```

```php
/**
 * HTTP client for the GitHub REST API.
 *
 * Handles authentication, rate limiting, error logging, and response parsing.
 * All tool classes delegate to this service — they never make HTTP calls directly.
 */
class GitHubService
```

```php
/**
 * Registers the GitHub integration with Laravel's service container.
 *
 * Binds GitHubService as a singleton using credentials from CredentialResolver,
 * and registers the GitHubToolProvider with the ToolProviderRegistry on boot.
 */
class GitHubServiceProvider extends ServiceProvider
```

### Constructor docblocks

When the constructor accepts dependencies, document them:

```php
/**
 * @param  GitHubService  $service  The GitHub API client
 */
public function __construct(
    private GitHubService $service,
) {}
```

For service constructors with credentials:

```php
/**
 * @param  string  $apiKey  GitHub personal access token or OAuth token
 */
public function __construct(
    private string $apiKey = '',
) {}
```

### Method docblocks

**Do document:**
- `execute()` — describe behavior and `@param array<string, mixed> $args`
- Service public methods — describe what they do, complex `@param`, `@return`, `@throws`
- `testConnection()` — `@param array<string, mixed> $config` and `@return array{success: bool, message?: string, error?: string}`

```php
/**
 * List repositories for the authenticated user.
 *
 * @param  array<string, mixed>  $params  Query parameters (type, sort, direction, per_page, page)
 * @return array<string, mixed>
 */
public function listRepos(array $params = []): array
```

```php
/**
 * Create a new GitHub issue.
 *
 * @param  array<string, mixed>  $args  Tool arguments (owner, repo, title, body, assignees, labels, milestone)
 */
public function execute(array $args): ToolResult
```

**Do NOT document:**
- `name()` — returns a literal string, self-documenting
- `description()` — returns a literal string, self-documenting
- `parameters()` — returns a literal array, self-documenting
- Trivial methods that just return a property or constant

### Interface implementations

When implementing `ConfigurableIntegration`, `HasTriggers`, or other interfaces, the method-level PHPDoc from the interface is inherited. You don't need to repeat it unless the implementation has non-obvious behavior.

## Coding Patterns

### Service class

- Constructor takes credentials as strings (injected by ServiceProvider)
- `isConfigured()` returns `bool` — checks if required credentials are present
- Private `request()` handles auth headers, HTTP method dispatch, error logging, response parsing
- Public methods grouped by resource with section comment headers
- Throw `RuntimeException` on API failures — tools catch these and return `ToolResult::error()`
- Use `Illuminate\Support\Facades\Http` for HTTP calls
- Use `Illuminate\Support\Facades\Log` for error logging

### Tool class

- Constructor takes the Service class
- `name()` returns the snake_case slug (e.g., `'github_create_issue'`)
- `description()` returns a clear multi-line description for AI agents
- `parameters()` returns a keyed array with `type`, `required`, `description`, optionally `enum`, `items`, `properties`
- `execute()` always wraps in try-catch, returns `ToolResult::success()` or `ToolResult::error()`
- Check `$this->service->isConfigured()` before API calls
- Translate `snake_case` parameters to API's format in `execute()` (e.g., `camelCase`)
- Return clean, focused data — not raw API response dumps

### ToolProvider

- Implements `ToolProvider` and `ConfigurableIntegration` (for credential-based integrations)
- Has a private `resolveService(array $context = [])` method for multi-account support
- `createTool()` delegates to `resolveService()`
- `credentialFields()` returns the required credentials
- `integrationMeta()` includes `category`: `'productivity'`, `'analytics'`, `'data'`, or `'rendering'`
- `testConnection()` makes a lightweight API call to verify credentials
- `configSchema()` returns form field definitions for the UI

### ServiceProvider

- Register the Service as a singleton using `CredentialResolver`
- Boot: register `ToolProvider` with `ToolProviderRegistry` (check `$this->app->bound()` first)

### Multi-account

All credential-based integrations must support multi-account:

```php
private function resolveService(array $context = []): GitHubService
{
    $account = $context['account'] ?? null;

    if ($account !== null) {
        $creds = app(CredentialResolver::class);

        return new GitHubService(
            apiKey: $creds->get('github', 'api_key', '', $account),
        );
    }

    return app(GitHubService::class);
}
```

## Naming Conventions

- Package directories: `kebab-case` (e.g., `clickup`, `google`, `exchange-rate`)
- Namespaces: `PascalCase` (e.g., `OpenCompany\Integrations\ClickUp\`)
- Tool class names: `{Name}{Action}` (e.g., `GitHubCreateIssue`)
- Tool names/slugs: `snake_case` (e.g., `github_create_issue`)
- Parameters: `snake_case`
- Icons: Phosphor (`ph:` prefix) via Iconify

## Integration Types

| Type | Auth | Example | Key Differences |
|------|------|---------|----------------|
| **A: Public API** | None | exchangerate, worldbank, coingecko | No `isConfigured()`, no multi-account, `credentialFields()` returns `[]` |
| **B: API Key** | API key | plausible, trustmrr, stripe | `isConfigured()` check, multi-account, `ConfigurableIntegration` |
| **C: OAuth** | OAuth tokens | clickup, ticktick, google | Same as B but credentials include access/refresh tokens |
| **D: Rendering** | None | mermaid, typst, vegalite | No credentials, uses `AgentFileStorage` |

## Before Building

1. Check `inspiration/index.md` for action coverage
2. Read the reference implementations: `plausible` (simple), `clickup` (complex), `coingecko` (public API)
3. Research the API via inspiration repos (Pipedream for breadth, n8n for params, Nango for auth)
4. One tool = one API operation. No god tools.

## Checklist

- [ ] `composer.json` with correct namespace, PSR-4, Laravel auto-discovery
- [ ] Service class with `isConfigured()` and methods grouped by resource
- [ ] ServiceProvider with singleton + registry registration
- [ ] ToolProvider with `ConfigurableIntegration` + multi-account `resolveService()`
- [ ] Tool classes: `name()`, `description()`, `parameters()`, `execute()` with try-catch
- [ ] PHPDoc on every class, constructor, `execute()`, and service methods
- [ ] `credentialFields()` for credential-based integrations
- [ ] `testConnection()` for credential-based integrations
- [ ] `lua-docs/{name}.md` for complex workflows
- [ ] All PHP files pass `php -l` syntax checks

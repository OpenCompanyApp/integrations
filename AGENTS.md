# AGENTS.md

Guidance for building and maintaining integration packages in this monorepo.

## What Good Looks Like

When adding or modifying an integration in this repo, optimize for:

- package quality over package count
- stable host behavior across OpenCompany and KosmoKrator
- clean metadata and naming in discovery UIs
- JavaScript docs that help agents use tools correctly on the first try
- deterministic tests with fake data only

This repo is a package monorepo, not a dumping ground for thin wrappers. If an integration is redundant, inconsistent, undocumented, or untested, it is not ready.

## Codebase Overview

This is a PHP 8.2+ monorepo of Composer packages that expose tools for AI agents. Each package under `packages/` is an independent Composer package built on a shared `core/`.

- **Tool** — A single callable action. Implements `name()`, `description()`, `parameters()`, `execute()`.
- **ToolProvider** — Groups tools under an app name. Declares metadata and handles instantiation.
- **ToolProviderRegistry** — Singleton that collects all providers for discovery.
- **CredentialResolver** — Abstraction for API keys. The host binds its own implementation.
- **Service** — HTTP client class that encapsulates all API communication for an integration.

For the full architecture, see `README.md`. For a step-by-step walkthrough, see `inspiration/AGENT-GUIDE.md`.

## Monorepo Rules

- Add new integrations under `packages/{name}` as Composer packages. Do not create separate repos for new integrations unless explicitly required.
- Prefer one canonical package per service family. Do not add duplicate legacy wrappers when an existing package already owns that namespace.
- If a legacy package must remain for compatibility, make it defer to the canonical package and declare the replacement clearly in Composer metadata.
- Keep package ids, namespaces, app names, and JavaScript namespaces aligned. Avoid `google-docs` vs `google_docs` style drift.
- Public-facing names must be human-readable. Do not use keyword blobs or SEO labels as the visible integration name.

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
    Triggers/                     # Only if the service supports webhooks
      {Name}WebhookTrigger.php
  script-docs/
    {name}.md                     # MANDATORY — supplementary docs for the AI agent
```

If you add tests, they belong in this repository under `tests/`, not in a host app such as KosmoKrator or OpenCompany.

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
- Normalize host-specific configuration in the service layer, not in tools
- Be conservative about fallback behavior: only add endpoint fallbacks that are known to be safe and intentional
- Prefer explicit unsupported-capability errors over misleading 401/404 leakage when a host deployment lacks an endpoint
- If an upstream API ignores filters, apply safe client-side filtering in the integration so tool behavior matches docs

### Tool class

- Constructor takes the Service class
- `name()` returns the snake_case slug (e.g., `'github_create_issue'`)
- `description()` returns a clear multi-line description for AI agents
- `parameters()` returns a keyed array with `type`, `required`, `description`, optionally `enum`, `items`, `properties`
- `execute()` always wraps in try-catch, returns `ToolResult::success()` or `ToolResult::error()`
- Check `$this->service->isConfigured()` before API calls
- Translate `snake_case` parameters to API's format in `execute()` (e.g., `camelCase`)
- Return clean, focused data — not raw API response dumps
- Do not expose obviously wrong or nonexistent fields just because a previous provider returned them
- If a tool supports ids and human references, document both clearly

### ToolProvider

- Implements `ToolProvider` and `ConfigurableIntegration` (for credential-based integrations)
- Has a private `resolveService(array $context = [])` method for multi-account support
- `createTool()` delegates to `resolveService()`
- `credentialFields()` returns the required credentials
- `integrationMeta()` includes `category`: `'productivity'`, `'analytics'`, `'data'`, or `'rendering'`
- `testConnection()` makes a lightweight API call to verify credentials
- `configSchema()` returns form field definitions for the UI
- `integrationMeta()['name']` should be the clean canonical display name shown in settings and catalogs
- Keep `appMeta()['label']` short and human-readable; do not stuff keywords into it

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

For package folder names, prefer the established package id over inventing a second alias. Do not introduce both `exchange-rate` and `exchangerate` variants, or both hyphen and underscore namespaces for the same service family.

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
5. Check whether the integration already exists under another package or namespace before adding anything new.
6. Decide whether the integration is public API, API key, OAuth, or rendering before you start coding.
7. Decide how the package behaves in both host apps:
   - OpenCompany
   - KosmoKrator

## Checklist

Every integration MUST have ALL applicable items checked. An integration is NOT complete without script-docs, PHPDoc, and all 4 core files.

### Mandatory (every integration)

- [ ] `composer.json` with correct namespace (`opencompanyapp/integration-{name}`), PSR-4, Laravel auto-discovery
- [ ] `src/{Name}Service.php` with `isConfigured()` and methods grouped by resource
- [ ] `src/{Name}ServiceProvider.php` with singleton + registry registration
- [ ] `src/{Name}ToolProvider.php` with `ConfigurableIntegration` + multi-account `resolveService()`
- [ ] `src/Tools/{Name}{Action}.php` — one file per tool, each with `name()`, `description()`, `parameters()`, `execute()` with try-catch
- [ ] `script-docs/{name}.md` — **MANDATORY for every integration, not optional**
- [ ] PHPDoc on every class (class docblock), constructor (`@param`), `execute()` (`@param array<string, mixed> $args`), and service methods (`@param` + `@return`)
- [ ] `credentialFields()` for credential-based integrations
- [ ] `testConnection()` for credential-based integrations
- [ ] All PHP files pass `php -l` syntax checks
- [ ] Tests added in this repo for non-trivial behavior, fallback logic, filters, or endpoint mapping
- [ ] No confidential domains, real tokens, real emails, or private project names in tests or docs
- [ ] JavaScript docs match the actual normalized tool output, not just the upstream API marketing docs
- [ ] Host behavior checked in both OpenCompany and KosmoKrator when the change affects discovery, credentials, JavaScript docs, or namespaces

### Strongly Recommended

- [ ] Add issue/reference fallback support when the upstream service clearly supports both UUIDs and human ids
- [ ] Add clear unsupported-feature messages for self-hosted or partial deployments
- [ ] Add client-side normalization when upstream pagination or filtering is inconsistent
- [ ] Keep response payloads small and shaped for agents, not humans reading raw REST blobs

## Testing Rules

- Put integration tests in this repository under `tests/`.
- Use fake hosts such as `example.test`, `example.invalid`, or clearly dummy values.
- Never put private domains, real workspace names, real project ids, real user emails, or real API keys into tests, fixtures, snapshots, or docs.
- Prefer `Http::fake()` for service and tool behavior tests.
- Test the integration layer's behavior, not Laravel internals.
- Add regression tests for:
  - endpoint fallbacks
  - multi-account resolution
  - filtered result shaping
  - unsupported-host behavior
  - metadata and naming regressions

## JavaScript Docs Rules

- `script-docs/{name}.md` is required.
- Document the namespace and the intended usage pattern.
- Document return shapes or normalized response notes when the output is not obvious.
- If the integration flattens or renames upstream fields, say so explicitly.
- Keep examples minimal, fake, and safe to publish.
- If a capability is host-version-specific or often unavailable on self-hosted deployments, say that explicitly instead of pretending it always works.

## Compatibility Rules

- Assume host apps may load packages dynamically from the monorepo without Composer requiring every package directly.
- Do not rely on fragile discovery side effects or duplicate package registration.
- Keep metadata compatible with both:
  - settings UIs
  - JavaScript namespace builders
- If a change affects discovery, visible naming, or namespace shape, verify both catalog output and UI-facing metadata.

### Common Mistakes to Avoid

1. **Forgetting script-docs** — Every integration needs `script-docs/{name}.md`. This is not optional.
2. **Forgetting PHPDoc** — Every class needs a docblock. Every constructor needs `@param`. Every `execute()` needs `@param array<string, mixed> $args`.
3. **Partial completions** — Do not submit with only Service + ServiceProvider but no ToolProvider or Tools.
4. **Missing ToolProvider** — Without it the integration won't appear in the registry.
5. **Missing ServiceProvider** — Without it Laravel won't register the integration.
6. **Forgetting triggers** — Services like GitHub, Slack, Stripe, Jira support webhooks. Add triggers for webhook-capable services.
7. **Not running syntax checks** — Always `php -l` all files before finishing.
8. **Leaking private data into tests** — Never use real customer, company, workspace, or token data in committed fixtures.
9. **Adding duplicate packages** — Fix duplication at the source package structure, do not hide it with registry hacks.
10. **Shipping keyword labels as names** — discovery UIs should show a clean integration name, not search terms.
11. **Trusting upstream filters blindly** — if the API ignores filters, tool behavior becomes misleading unless you normalize it.
12. **Writing docs from API assumptions** — inspect the actual normalized tool output before documenting examples.

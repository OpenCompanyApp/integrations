# CLAUDE.md

Contributor guidance for the OpenCompany integrations monorepo.

Read [AGENTS.md](/Users/rutger/Sites/integrations/AGENTS.md) first. This file is the short operational version.

## Scope

This repo contains Composer packages under `packages/` plus shared code under `core/`.

- New integrations belong in `packages/{name}`
- Tests for integrations belong in this repo under `tests/`
- Do not move package-specific tests into host apps like KosmoKrator or OpenCompany

## Rules

- Prefer one canonical package per service family
- Do not add duplicate wrappers or alternate namespace spellings unless explicitly needed for compatibility
- Keep visible names clean and human-readable
- Keep JavaScript namespaces, package ids, metadata, and docs aligned
- Do not commit real domains, real emails, real project names, or real API tokens in tests or docs

## Before You Add An Integration

1. Check whether the service already exists in `packages/`
2. Check whether a canonical package already owns that namespace
3. Decide the auth model:
   - public
   - API key
   - OAuth
   - rendering
4. Decide what should happen in both host apps:
   - OpenCompany
   - KosmoKrator

## Required Files

- `composer.json`
- `src/{Name}Service.php`
- `src/{Name}ServiceProvider.php`
- `src/{Name}ToolProvider.php`
- `src/Tools/...`
- `script-docs/{name}.md`

## Quality Bar

- Tools should return shaped agent-friendly output, not raw API dumps
- Services should own normalization, endpoint quirks, and safe fallbacks
- Unsupported capabilities should fail clearly
- JavaScript docs should reflect actual tool behavior, including normalized output and self-hosted caveats
- Non-trivial behavior needs tests in this repo

## Test Rules

- Use fake hosts like `example.test`
- Use fake credentials and fake ids
- Prefer `Http::fake()`
- Add regression tests for endpoint mapping, fallbacks, filters, and naming

## Finish Checklist

- Run syntax checks
- Run the relevant PHPUnit coverage in this repo
- Check metadata and naming
- Check JavaScript docs
- Make sure the worktree is clean before you stop

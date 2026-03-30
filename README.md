# OpenCompany Integrations

Monorepo for all OpenCompany integration packages.

## Structure

```
core/           — Shared contracts (Tool, ToolProvider, CredentialResolver), ToolResult, ToolProviderRegistry
celestial/      — Astronomy: moon phases, sunrise/sunset, planet positions, eclipses
clickup/        — ClickUp project management: tasks, lists, folders, time tracking
coingecko/      — CoinGecko cryptocurrency: prices, market data, trending, charts
exchangerate/   — Currency exchange rates: 340 fiat, crypto, and metal conversions
google/         — Google Calendar and Gmail
mermaid/        — Mermaid diagram rendering
plantuml/       — PlantUML diagram rendering
plausible/      — Plausible Analytics: stats, realtime visitors, goals
ticktick/       — TickTick task management
trustmrr/       — TrustMRR verified startup revenue data
typst/          — Typst document rendering
vegalite/       — Vega-Lite chart rendering
worldbank/      — World Bank economic indicators
```

## Usage

Each subdirectory is an independent Composer package. In the consuming application's `composer.json`:

```json
{
    "repositories": [
        {"type": "path", "url": "tmp/integrations/*"}
    ],
    "require": {
        "opencompanyapp/integration-core": "@dev",
        "opencompanyapp/integration-mermaid": "@dev"
    }
}
```

## Adding a New Integration

Create a new directory with a `composer.json` following the pattern in any existing package. The package will be auto-discovered via the wildcard path repository.

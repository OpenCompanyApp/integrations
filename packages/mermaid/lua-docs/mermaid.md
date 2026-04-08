# Mermaid — Lua API Reference

## render_mermaid

Render Mermaid diagram syntax (flowcharts, sequence, ER, class, state, Gantt, and more) to a PNG image.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `syntax` | string | yes | Mermaid diagram syntax. Must be valid Mermaid markup (e.g., starting with `graph TD`, `sequenceDiagram`, `erDiagram`, etc.). |
| `title` | string | no | Diagram title used as alt text (default: `"Diagram"`). |
| `width` | integer | no | Output width in pixels (default: 1400, range: 100–4000). |
| `theme` | string | no | Mermaid theme (default: `"default"`). One of: `"default"`, `"dark"`, `"forest"`, `"neutral"`. |

### Examples

#### Render a flowchart

```lua
local result = app.integrations.mermaid.render_mermaid({
  syntax = "graph TD\n  A[Start] --> B{Decision}\n  B -->|Yes| C[Action]\n  B -->|No| D[End]",
  title = "Simple Flowchart",
  theme = "default"
})
```

#### Render a sequence diagram with dark theme

```lua
local result = app.integrations.mermaid.render_mermaid({
  syntax = "sequenceDiagram\n  participant Client\n  participant Server\n  Client->>Server: Request\n  Server-->>Client: Response",
  title = "Client-Server Sequence",
  theme = "dark"
})
```

#### Render an ER diagram

```lua
local result = app.integrations.mermaid.render_mermaid({
  syntax = "erDiagram\n  CUSTOMER ||--o{ ORDER : places\n  ORDER ||--|{ LINE-ITEM : contains",
  title = "Entity Relationship",
  width = 1200
})
```

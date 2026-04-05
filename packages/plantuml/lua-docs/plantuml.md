# PlantUML — Lua API Reference

## render_plantuml

Render PlantUML diagram syntax (class, sequence, activity, component, state, use case, and more) to a PNG image.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `syntax` | string | yes | PlantUML diagram syntax. Should be wrapped in `@startuml`/`@enduml` (auto-wrapped if missing). |
| `title` | string | no | Diagram title used as alt text (default: `"Diagram"`). |

### Examples

#### Render a class diagram

```lua
local result = app.integrations.plantuml.render_plantuml({
  syntax = "@startuml\nclass Animal {\n  +name: string\n  +speak(): void\n}\nclass Dog extends Animal {\n  +fetch(): void\n}\n@enduml",
  title = "Class Diagram"
})
```

#### Render a sequence diagram

```lua
local result = app.integrations.plantuml.render_plantuml({
  syntax = "@startuml\nAlice -> Bob: Hello\nBob --> Alice: Hi there!\n@enduml",
  title = "Sequence Diagram"
})
```

#### Render a component diagram

```lua
local result = app.integrations.plantuml.render_plantuml({
  syntax = "@startuml\n[Web App] --> [API Gateway]\n[API Gateway] --> [Auth Service]\n[API Gateway] --> [Database]\n@enduml",
  title = "Architecture"
})
```
